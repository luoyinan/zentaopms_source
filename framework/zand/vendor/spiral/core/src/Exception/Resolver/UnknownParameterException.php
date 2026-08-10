<?php

namespace Spiral\Core\Exception\Resolver;

use Spiral\Core\Exception\Traits\ClosureRendererTrait;

final class UnknownParameterException extends ValidationException
{
    use ClosureRendererTrait;

    public function __construct(
        $reflection,
        private readonly $parameter
    ) {
        $pattern = "Unknown named parameter `{$parameter}` `%s` %s.";
        parent::__construct($this->renderFunctionAndParameter($reflection, $pattern));
    }

    public function getParameter()
    {
        return $this->parameter;
    }
}
