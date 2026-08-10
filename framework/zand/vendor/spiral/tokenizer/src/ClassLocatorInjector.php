<?php

namespace Spiral\Tokenizer;

use Spiral\Core\Container\InjectorInterface;
use Spiral\Core\Exception\Container\InjectionException;

/**
 * Manages automatic container injections of class and invocation locators.
 *
 * @implements InjectorInterface<ClassLocator>
 */
final class ClassLocatorInjector implements InjectorInterface
{
    public function __construct(
        private readonly $tokenizer
    ) {
    }

    /**
     * @throws InjectionException
     */
    public function createInjection(
        $class,
        $context = null
    ) {
        return $this->tokenizer->classLocator();
    }
}
