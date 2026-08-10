<?php

namespace Spiral\Core\Exception\Resolver;

use Spiral\Core\Exception\Traits\ClosureRendererTrait;

final class PositionalArgumentException extends ValidationException
{
    use ClosureRendererTrait;

    public function __construct(
        $reflection,
        private readonly $position
    ) {
        $pattern = 'Cannot use positional argument after named argument `%s` %s.';
        parent::__construct($this->renderFunctionAndParameter($reflection, $pattern));
    }

    public function getParameter()
    {
        return '#' . $this->position;
    }
}
