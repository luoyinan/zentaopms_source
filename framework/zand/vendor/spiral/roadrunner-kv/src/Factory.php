<?php

namespace Spiral\RoadRunner\KeyValue;

use Spiral\Goridge\RPC\RPCInterface;
use Spiral\RoadRunner\KeyValue\Serializer\SerializerAwareTrait;
use Spiral\RoadRunner\KeyValue\Serializer\SerializerInterface;
use Spiral\RoadRunner\KeyValue\Serializer\DefaultSerializer;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class Factory implements FactoryInterface
{
    use SerializerAwareTrait;

    private RPCInterface $rpc;

    public function __construct($rpc, $serializer = null)
    {
        $this->rpc = $rpc;
        $this->setSerializer($serializer ?? new DefaultSerializer());
    }

    public function select($name)
    {
        return new Cache($this->rpc, $name, $this->getSerializer());
    }
}
