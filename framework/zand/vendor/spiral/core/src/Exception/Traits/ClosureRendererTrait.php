<?php

namespace Spiral\Core\Exception\Traits;

use ReflectionFunction;
use ReflectionNamedType;
use ReflectionUnionType;

trait ClosureRendererTrait
{
    /**
     * @param string $pattern String that contains method and fileAndLine markers
     */
    protected function renderFunctionAndParameter(
        $reflection,
        $pattern
    ) {
        $function = $reflection->getName();
        /** @var class-string|null $class */
        $class = $reflection->class ?? null;

        $method = match (true) {
            $class !== null => "{$class}::{$function}",
            $reflection->isClosure() => $this->renderClosureSignature($reflection),
            default => $function,
        };

        $fileName = $reflection->getFileName();
        $line = $reflection->getStartLine();

        $fileAndLine = '';
        if (!empty($fileName)) {
            $fileAndLine = "in \"$fileName\" at line $line";
        }

        return \sprintf($pattern, $method, $fileAndLine);
    }

    private function renderClosureSignature($reflection)
    {
        $closureParameters = [];

        foreach ($reflection->getParameters() as $parameter) {
            /** @var ReflectionNamedType|ReflectionUnionType|null $type */
            $type = $parameter->getType();
            $parameterString = \sprintf(
                '%s %s%s$%s',
                // type
                (string) $type,
                // reference
                $parameter->isPassedByReference() ? '&' : '',
                // variadic
                $parameter->isVariadic() ? '...' : '',
                $parameter->getName(),
            );
            if ($parameter->isDefaultValueAvailable()) {
                $default = $parameter->getDefaultValue();
                $parameterString .= ' = ' . match (true) {
                    \is_object($default) => 'new ' . $default::class . '(...)',
                    $parameter->isDefaultValueConstant() => $parameter->getDefaultValueConstantName(),
                    default => \var_export($default, true),
                };
            }
            $closureParameters[] = \ltrim($parameterString);
        }
        $static = $reflection->isStatic() ? 'static ' : '';
        return "{$static}function (" . \implode(', ', $closureParameters) . ')';
    }
}
