<?php

namespace Spiral\Tokenizer\Bootloader;

use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\DirectoriesInterface;
use Spiral\Config\ConfiguratorInterface;
use Spiral\Config\Patch\Append;
use Spiral\Core\BinderInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Tokenizer\ClassesInterface;
use Spiral\Tokenizer\ClassLocator;
use Spiral\Tokenizer\ClassLocatorInjector;
use Spiral\Tokenizer\Config\TokenizerConfig;
use Spiral\Tokenizer\InvocationLocator;
use Spiral\Tokenizer\InvocationLocatorInjector;
use Spiral\Tokenizer\InvocationsInterface;
use Spiral\Tokenizer\ScopedClassesInterface;
use Spiral\Tokenizer\ScopedClassLocator;

final class TokenizerBootloader extends Bootloader implements SingletonInterface
{
    protected const BINDINGS = [
        ScopedClassesInterface::class => ScopedClassLocator::class,
        ClassesInterface::class => ClassLocator::class,
        InvocationsInterface::class => InvocationLocator::class,
    ];

    public function __construct(
        private readonly $config,
    ) {
    }

    public function init($binder, $dirs)
    {
        /** @psalm-suppress InvalidCast https://github.com/vimeo/psalm/issues/8810 */
        $binder->bindInjector(ClassLocator::class, ClassLocatorInjector::class);
        /** @psalm-suppress InvalidCast https://github.com/vimeo/psalm/issues/8810 */
        $binder->bindInjector(InvocationLocator::class, InvocationLocatorInjector::class);

        $this->config->setDefaults(
            TokenizerConfig::CONFIG,
            [
                'debug' => false,
                'directories' => [$dirs->get('app')],
                'exclude' => [
                    $dirs->get('resources'),
                    $dirs->get('config'),
                    'tests',
                    'migrations',
                ],
            ]
        );
    }

    /**
     * Add directory for indexation.
     */
    public function addDirectory($directory)
    {
        $this->config->modify(
            TokenizerConfig::CONFIG,
            new Append('directories', null, $directory)
        );
    }

    /**
     * Add directory for indexation into specific scope.
     */
    public function addScopedDirectory($scope, $directory)
    {
        if (!isset($this->config->getConfig(TokenizerConfig::CONFIG)['scopes'][$scope])) {
            $this->config->modify(
                TokenizerConfig::CONFIG,
                new Append('scopes', $scope, [])
            );
        }

        $this->config->modify(
            TokenizerConfig::CONFIG,
            new Append('scopes.' . $scope, null, $directory)
        );
    }
}
