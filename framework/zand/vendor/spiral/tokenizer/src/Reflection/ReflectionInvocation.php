<?php

namespace Spiral\Tokenizer\Reflection;

use Spiral\Tokenizer\Exception\ReflectionException;

/**
 * ReflectionInvocation used to represent function or static method call found by ReflectionFile.
 * This reflection is very useful for static analysis and mainly used in Translator component to
 * index translation function usages.
 */
final class ReflectionInvocation
{
    /**
     * New call reflection.
     *
     * @param class-string $class
     * @param ReflectionArgument[] $arguments
     * @param int $level Was a function used inside another function call?
     */
    public function __construct(
        private readonly $filename,
        private readonly $line,
        private readonly $class,
        private readonly $operator,
        private readonly $name,
        private readonly $arguments,
        private readonly $source,
        private readonly $level
    ) {
    }

    /**
     * Function usage filename.
     */
    public function getFilename()
    {
        return \str_replace('\\', '/', $this->filename);
    }

    /**
     * Function usage line.
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Parent class.
     *
     * @return class-string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Method operator (:: or ->).
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Function or method name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Call made by class method.
     */
    public function isMethod()
    {
        return !empty($this->class);
    }

    /**
     * Function usage src.
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Count of arguments in call.
     */
    public function countArguments()
    {
        return \count($this->arguments);
    }

    /**
     * All parsed function arguments.
     *
     * @return ReflectionArgument[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Get call argument by it position.
     */
    public function getArgument(int $index)
    {
        if (!isset($this->arguments[$index])) {
            throw new ReflectionException(\sprintf("No such argument with index '%d'", $index));
        }

        return $this->arguments[$index];
    }

    /**
     * Invoking level.
     */
    public function getLevel()
    {
        return $this->level;
    }
}
