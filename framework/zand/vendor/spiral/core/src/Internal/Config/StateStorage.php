<?php

namespace Spiral\Core\Internal\Config;

use Spiral\Core\Internal\State;

class StateStorage
{
    /** @var array<string, State> */
    private array $states = [];

    /**
     * Get bindings for the given scope.
     */
    public function getState($scope)
    {
        return $this->states[$scope] ??= new State();
    }
}
