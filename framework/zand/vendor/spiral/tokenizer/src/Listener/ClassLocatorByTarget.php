<?php

namespace Spiral\Tokenizer\Listener;

use Spiral\Tokenizer\Attribute\AbstractTarget;
use Spiral\Tokenizer\ClassesInterface;
use Spiral\Tokenizer\ScopedClassesInterface;
use Spiral\Tokenizer\Traits\TargetTrait;

/**
 * @internal
 */
final class ClassLocatorByTarget
{
    use TargetTrait;

    public function __construct(
        private readonly $classes,
        private readonly $scopedClasses,
    ) {
    }

    /**
     * @return class-string[]
     */
    public function getClasses($target)
    {
        return \iterator_to_array(
            $target->filter(
                $this->findClasses($target),
            ),
        );
    }

    /**
     * @return \ReflectionClass[]
     */
    private function findClasses($target)
    {
        $scope = $target->getScope();

        // If scope for listener attribute is defined, we should use scoped class locator
        return $scope !== null
            ? $this->scopedClasses->getScopedClasses($scope)
            : $this->classes->getClasses();
    }
}
