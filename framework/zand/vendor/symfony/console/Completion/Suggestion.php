<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Completion;

/**
 * Represents a single suggested value.
 *
 * @author Wouter de Jong <wouter@wouterj.nl>
 */
class Suggestion implements \Stringable
{
    public function __construct(
        private readonly $value,
        private readonly $description = ''
    ) {
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
