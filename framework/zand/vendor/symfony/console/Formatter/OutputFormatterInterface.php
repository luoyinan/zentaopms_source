<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Formatter;

/**
 * Formatter interface for console output.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface OutputFormatterInterface
{
    /**
     * Sets the decorated flag.
     *
     * @return void
     */
    public function setDecorated($decorated);

    /**
     * Whether the output will decorate messages.
     */
    public function isDecorated();

    /**
     * Sets a new style.
     *
     * @return void
     */
    public function setStyle($name, $style);

    /**
     * Checks if output formatter has style with specified name.
     */
    public function hasStyle($name);

    /**
     * Gets style options from style with specified name.
     *
     * @throws \InvalidArgumentException When style isn't defined
     */
    public function getStyle($name);

    /**
     * Formats a message according to the given styles.
     */
    public function format($message);
}
