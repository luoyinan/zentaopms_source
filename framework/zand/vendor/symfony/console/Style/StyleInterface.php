<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Style;

/**
 * Output style helpers.
 *
 * @author Kevin Bond <kevinbond@gmail.com>
 */
interface StyleInterface
{
    /**
     * Formats a command title.
     *
     * @return void
     */
    public function title($message);

    /**
     * Formats a section title.
     *
     * @return void
     */
    public function section($message);

    /**
     * Formats a list.
     *
     * @return void
     */
    public function listing($elements);

    /**
     * Formats informational text.
     *
     * @return void
     */
    public function text($message);

    /**
     * Formats a success result bar.
     *
     * @return void
     */
    public function success($message);

    /**
     * Formats an error result bar.
     *
     * @return void
     */
    public function error($message);

    /**
     * Formats an warning result bar.
     *
     * @return void
     */
    public function warning($message);

    /**
     * Formats a note admonition.
     *
     * @return void
     */
    public function note($message);

    /**
     * Formats a caution admonition.
     *
     * @return void
     */
    public function caution($message);

    /**
     * Formats a table.
     *
     * @return void
     */
    public function table($headers, $rows);

    /**
     * Asks a question.
     */
    public function ask($question, $default = null, $validator = null);

    /**
     * Asks a question with the user input hidden.
     */
    public function askHidden($question, $validator = null);

    /**
     * Asks for confirmation.
     */
    public function confirm($question, $default = true);

    /**
     * Asks a choice question.
     */
    public function choice($question, $choices, $default = null);

    /**
     * Add newline(s).
     *
     * @return void
     */
    public function newLine($count = 1);

    /**
     * Starts the progress output.
     *
     * @return void
     */
    public function progressStart($max = 0);

    /**
     * Advances the progress output X steps.
     *
     * @return void
     */
    public function progressAdvance($step = 1);

    /**
     * Finishes the progress output.
     *
     * @return void
     */
    public function progressFinish();
}
