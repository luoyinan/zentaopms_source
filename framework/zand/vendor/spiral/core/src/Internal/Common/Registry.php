<?php

namespace Spiral\Core\Internal\Common;

use Spiral\Core\Config;

/**
 * @internal
 */
final class Registry
{
    /**
     * @param array<string, object> $objects
     */
    public function __construct(
        private $config,
        private $objects = [],
    ) {
    }

    public function set(string $name, object $value)
    {
        $this->objects[$name] = $value;
    }

    /**
     * @template T
     *
     * @param class-string<T> $interface
     *
     * @return T
     */
    public function get(string $name, string $interface)
    {
        $className = $this->config->$name;
        $result = $this->objects[$name] ?? new $className($this);
        \assert($result instanceof $interface);
        return $result;
    }
}
