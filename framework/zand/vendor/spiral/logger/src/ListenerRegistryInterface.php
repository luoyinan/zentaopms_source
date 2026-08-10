<?php

namespace Spiral\Logger;

interface ListenerRegistryInterface
{
    /**
     * Add new even listener.
     */
    public function addListener($listener);

    /**
     * Add LogEvent listener.
     */
    public function removeListener($listener);

    /**
     * @return callable[]
     */
    public function getListeners();
}
