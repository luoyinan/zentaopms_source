<?php

namespace Spiral\RoadRunner\KeyValue\Serializer;

interface SerializerAwareInterface
{
    /**
     * @return $this
     */
    public function withSerializer($serializer);

    public function getSerializer();
}
