<?php

namespace Spiral\Core\Exception\Scope;

use Spiral\Core\Exception\Container\ContainerException;

/**
 * @internal
 */
abstract class ScopeException extends ContainerException
{
    public function __construct(
        protected $scope,
        $message = '',
        $code = 0,
        $previous = null,
    ) {
        parent::__construct(
            $message,
            $code,
            $previous,
        );
    }

    public function getScope()
    {
        return $this->scope;
    }
}
