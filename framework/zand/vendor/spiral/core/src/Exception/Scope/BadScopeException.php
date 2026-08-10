<?php

namespace Spiral\Core\Exception\Scope;

/**
 * @method string getScope()
 */
final class BadScopeException extends ScopeException
{
    public function __construct(
        $scope,
        protected $className,
    ) {
        parent::__construct(
            $scope,
            \sprintf('Class `%s` can be resolved only in `%s` scope.', $className, $scope),
        );
    }
}
