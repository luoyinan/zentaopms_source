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
 * Formatter style interface for defining styles.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface OutputFormatterStyleInterface
{
    /**
     * Sets style foreground color.
     *
     * @return void
     */
    public function setForeground($color);

    /**
     * Sets style background color.
     *
     * @return void
     */
    public function setBackground($color);

    /**
     * Sets some specific style option.
     *
     * @return void
     */
    public function setOption($option);

    /**
     * Unsets some specific style option.
     *
     * @return void
     */
    public function unsetOption($option);

    /**
     * Sets multiple style options at once.
     *
     * @return void
     */
    public function setOptions($options);

    /**
     * Applies the style to a given text.
     */
    public function apply($text);
}
