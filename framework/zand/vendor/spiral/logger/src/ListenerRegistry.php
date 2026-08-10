<?php

namespace Spiral\Logger;

/**
 * Contains all log listeners.
 */
final class ListenerRegistry implements ListenerRegistryInterface
{
    /** @var callable[] */
    private array $listeners = [];

    public function addListener($listener)
    {
        if (!\in_array($listener, $this->listeners, true)) {
            $this->listeners[] = $listener;
        }

        return $this;
    }

    public function removeListener($listener)
    {
        $key = \array_search($listener, $this->listeners, true);
        if ($key !== null) {
            unset($this->listeners[$key]);
        }
    }

    /**
     * @return callable[]
     */
    public function getListeners()
    {
        return $this->listeners;
    }
}
