<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpClient\Chunk;

use Symfony\Component\HttpClient\Exception\TimeoutException;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\ChunkInterface;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @internal
 */
class ErrorChunk implements ChunkInterface
{
    private bool $didThrow = false;
    private int $offset;
    private string $errorMessage;
    private ?\Throwable $error = null;

    public function __construct($offset, $error)
    {
        $this->offset = $offset;

        if (\is_string($error)) {
            $this->errorMessage = $error;
        } else {
            $this->error = $error;
            $this->errorMessage = $error->getMessage();
        }
    }

    public function isTimeout()
    {
        $this->didThrow = true;

        if (null !== $this->error) {
            throw new TransportException($this->errorMessage, 0, $this->error);
        }

        return true;
    }

    public function isFirst()
    {
        $this->didThrow = true;
        throw null !== $this->error ? new TransportException($this->errorMessage, 0, $this->error) : new TimeoutException($this->errorMessage);
    }

    public function isLast()
    {
        $this->didThrow = true;
        throw null !== $this->error ? new TransportException($this->errorMessage, 0, $this->error) : new TimeoutException($this->errorMessage);
    }

    public function getInformationalStatus()
    {
        $this->didThrow = true;
        throw null !== $this->error ? new TransportException($this->errorMessage, 0, $this->error) : new TimeoutException($this->errorMessage);
    }

    public function getContent()
    {
        $this->didThrow = true;
        throw null !== $this->error ? new TransportException($this->errorMessage, 0, $this->error) : new TimeoutException($this->errorMessage);
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getError()
    {
        return $this->errorMessage;
    }

    public function didThrow($didThrow = null)
    {
        if (null !== $didThrow && $this->didThrow !== $didThrow) {
            return !$this->didThrow = $didThrow;
        }

        return $this->didThrow;
    }

    public function __sleep()
    {
        throw new \BadMethodCallException('Cannot serialize '.__CLASS__);
    }

    public function __wakeup()
    {
        throw new \BadMethodCallException('Cannot unserialize '.__CLASS__);
    }

    public function __destruct()
    {
        if (!$this->didThrow) {
            $this->didThrow = true;
            throw null !== $this->error ? new TransportException($this->errorMessage, 0, $this->error) : new TimeoutException($this->errorMessage);
        }
    }
}
