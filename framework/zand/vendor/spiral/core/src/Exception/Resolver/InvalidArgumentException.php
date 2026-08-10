<?php

namespace Spiral\Core\Exception\Resolver;

use Spiral\Core\Exception\Traits\ClosureRendererTrait;

final class InvalidArgumentException extends ValidationException
{
    use ClosureRendererTrait;

    public function __construct(
        $reflection,
        private readonly $parameter
    ) {
        $pattern = "Invalid argument value type for the `$parameter` parameter when validating arguments for `%s`.";
        parent::__construct($this->renderFunctionAndParameter($reflection, $pattern));
    }

    public function getParameter()
    {
        return $this->parameter;
    }
}
