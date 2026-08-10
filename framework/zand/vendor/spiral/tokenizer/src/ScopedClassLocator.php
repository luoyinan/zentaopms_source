<?php

namespace Spiral\Tokenizer;

final class ScopedClassLocator implements ScopedClassesInterface
{
    public function __construct(
        private readonly $tokenizer
    ) {
    }

    public function getScopedClasses($scope, $target = null)
    {
        return $this->tokenizer->scopedClassLocator($scope)->getClasses($target);
    }
}
