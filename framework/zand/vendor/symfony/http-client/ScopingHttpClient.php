<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpClient;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\Exception\InvalidArgumentException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;
use Symfony\Contracts\Service\ResetInterface;

/**
 * Auto-configure the default options based on the requested URL.
 *
 * @author Anthony Martin <anthony.martin@sensiolabs.com>
 */
class ScopingHttpClient implements HttpClientInterface, ResetInterface, LoggerAwareInterface
{
    use HttpClientTrait;

    private HttpClientInterface $client;
    private array $defaultOptionsByRegexp;
    private ?string $defaultRegexp;

    public function __construct($client, $defaultOptionsByRegexp, $defaultRegexp = null)
    {
        $this->client = $client;
        $this->defaultOptionsByRegexp = $defaultOptionsByRegexp;
        $this->defaultRegexp = $defaultRegexp;

        if (null !== $defaultRegexp && !isset($defaultOptionsByRegexp[$defaultRegexp])) {
            throw new InvalidArgumentException(sprintf('No options are mapped to the provided "%s" default regexp.', $defaultRegexp));
        }
    }

    public static function forBaseUri($client, $baseUri, $defaultOptions = [], $regexp = null)
    {
        $regexp ??= preg_quote(implode('', self::resolveUrl(self::parseUrl('.'), self::parseUrl($baseUri))));

        $defaultOptions['base_uri'] = $baseUri;

        return new self($client, [$regexp => $defaultOptions], $regexp);
    }

    public function request($method, $url, $options = [])
    {
        $e = null;
        $url = self::parseUrl($url, $options['query'] ?? []);

        if (\is_string($options['base_uri'] ?? null)) {
            $options['base_uri'] = self::parseUrl($options['base_uri']);
        }

        try {
            $url = implode('', self::resolveUrl($url, $options['base_uri'] ?? null));
        } catch (InvalidArgumentException $e) {
            if (null === $this->defaultRegexp) {
                throw $e;
            }

            $defaultOptions = $this->defaultOptionsByRegexp[$this->defaultRegexp];
            $options = self::mergeDefaultOptions($options, $defaultOptions, true);
            if (\is_string($options['base_uri'] ?? null)) {
                $options['base_uri'] = self::parseUrl($options['base_uri']);
            }
            $url = implode('', self::resolveUrl($url, $options['base_uri'] ?? null, $defaultOptions['query'] ?? []));
        }

        foreach ($this->defaultOptionsByRegexp as $regexp => $defaultOptions) {
            if (preg_match("{{$regexp}}A", $url)) {
                if (null === $e || $regexp !== $this->defaultRegexp) {
                    $options = self::mergeDefaultOptions($options, $defaultOptions, true);
                }
                break;
            }
        }

        return $this->client->request($method, $url, $options);
    }

    public function stream($responses, $timeout = null)
    {
        return $this->client->stream($responses, $timeout);
    }

    /**
     * @return void
     */
    public function reset()
    {
        if ($this->client instanceof ResetInterface) {
            $this->client->reset();
        }
    }

    public function setLogger($logger)
    {
        if ($this->client instanceof LoggerAwareInterface) {
            $this->client->setLogger($logger);
        }
    }

    public function withOptions($options)
    {
        $clone = clone $this;
        $clone->client = $this->client->withOptions($options);

        return $clone;
    }
}
