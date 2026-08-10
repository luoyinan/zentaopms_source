<?php

namespace Spiral\RoadRunner\Jobs\Serializer;

use Spiral\RoadRunner\Jobs\Exception\SerializationException;

final class JsonSerializer implements SerializerInterface
{
    /**
     * {@inheritDoc}
     */
    public function serialize($payload)
    {
        try {
            return \json_encode($payload, \JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            throw new SerializationException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deserialize($payload)
    {
        try {
            return (array)\json_decode($payload, true, 512, \JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            throw new SerializationException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}
