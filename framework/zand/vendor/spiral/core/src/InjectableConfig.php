<?php

namespace Spiral\Core;

use Spiral\Core\Container\InjectableInterface;
use Spiral\Core\Exception\ConfigException;

/**
 * Generic implementation of array based configuration.
 *
 * @implements \IteratorAggregate<array-key, mixed>
 * @implements \ArrayAccess<array-key, mixed>
 */
abstract class InjectableConfig implements InjectableInterface, \IteratorAggregate, \ArrayAccess
{
    /**
     * @var class-string<ConfigsInterface>
     */
    public const INJECTOR = ConfigsInterface::class;

    protected array $config = [];

    /**
     * At this moment on array based configs can be supported.
     * @param array $config Configuration data
     */
    public function __construct($config = [])
    {
        $this->config = $config + $this->config;
    }

    /**
     * Restoring state.
     */
    public static function __set_state($anArray)
    {
        return new static($anArray['config']);
    }

    public function toArray()
    {
        return $this->config;
    }

    public function offsetExists(mixed $offset)
    {
        return \array_key_exists($offset, $this->config);
    }

    public function offsetGet(mixed $offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new ConfigException(\sprintf("Undefined configuration key '%s'", $offset));
        }

        return $this->config[$offset];
    }

    /**
     * @throws ConfigException
     */
    public function offsetSet(mixed $offset, mixed $value)
    {
        throw new ConfigException(
            'Unable to change configuration data, configs are treated as immutable by default'
        );
    }

    /**
     * @throws ConfigException
     */
    public function offsetUnset(mixed $offset)
    {
        throw new ConfigException(
            'Unable to change configuration data, configs are treated as immutable by default'
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->config);
    }
}
