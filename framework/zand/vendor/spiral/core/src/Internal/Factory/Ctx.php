<?php

namespace Spiral\Core\Internal\Factory;

/**
 * @template TClass of object
 */
final class Ctx
{
    /**
     * @param class-string<TClass> $class
     * @param null|\ReflectionClass<TClass> $reflection
     */
    public function __construct(
        public readonly $alias,
        public $class,
        public $parameter = null,
        public $singleton = null,
        public $reflection = null,
    ) {
    }
}
