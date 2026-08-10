<?php

namespace Spiral\RoadRunner\KeyValue\Serializer;

trait SerializerAwareTrait
{
    protected SerializerInterface $serializer;

    protected function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param SerializerInterface $serializer
     * @return $this
     */
    public function withSerializer($serializer)
    {
        $self = clone $this;
        $self->setSerializer($serializer);

        return $self;
    }

    public function getSerializer()
    {
        return $this->serializer;
    }
}
