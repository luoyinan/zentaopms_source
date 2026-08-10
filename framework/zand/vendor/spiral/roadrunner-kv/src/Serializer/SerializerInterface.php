<?php

namespace Spiral\RoadRunner\KeyValue\Serializer;

use Spiral\RoadRunner\KeyValue\Exception\SerializationException;

interface SerializerInterface
{
    /**
     * @throws SerializationException
     */
    public function serialize($value);

    /**
     * @throws SerializationException
     */
    public function unserialize($value);
}
