<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\Completion\CompletionSuggestions;
use Symfony\Component\Console\Completion\Suggestion;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
final class LazyCommand extends Command
{
    private \Closure|Command $command;
    private ?bool $isEnabled;

    public function __construct($name, $aliases, $description, $isHidden, $commandFactory, $isEnabled = true)
    {
        $this->setName($name)
            ->setAliases($aliases)
            ->setHidden($isHidden)
            ->setDescription($description);

        $this->command = $commandFactory;
        $this->isEnabled = $isEnabled;
    }

    public function ignoreValidationErrors()
    {
        $this->getCommand()->ignoreValidationErrors();
    }

    public function setApplication($application = null)
    {
        if (1 > \func_num_args()) {
            trigger_deprecation('symfony/console', '6.2', 'Calling "%s()" without any arguments is deprecated, pass null explicitly instead.', __METHOD__);
        }
        if ($this->command instanceof parent) {
            $this->command->setApplication($application);
        }

        parent::setApplication($application);
    }

    public function setHelperSet($helperSet)
    {
        if ($this->command instanceof parent) {
            $this->command->setHelperSet($helperSet);
        }

        parent::setHelperSet($helperSet);
    }

    public function isEnabled()
    {
        return $this->isEnabled ?? $this->getCommand()->isEnabled();
    }

    public function run($input, $output)
    {
        return $this->getCommand()->run($input, $output);
    }

    public function complete($input, $suggestions)
    {
        $this->getCommand()->complete($input, $suggestions);
    }

    public function setCode($code)
    {
        $this->getCommand()->setCode($code);

        return $this;
    }

    /**
     * @internal
     */
    public function mergeApplicationDefinition($mergeArgs = true)
    {
        $this->getCommand()->mergeApplicationDefinition($mergeArgs);
    }

    public function setDefinition($definition)
    {
        $this->getCommand()->setDefinition($definition);

        return $this;
    }

    public function getDefinition()
    {
        return $this->getCommand()->getDefinition();
    }

    public function getNativeDefinition()
    {
        return $this->getCommand()->getNativeDefinition();
    }

    /**
     * @param array|\Closure(CompletionInput,CompletionSuggestions):list<string|Suggestion> $suggestedValues The values used for input completion
     */
    public function addArgument($name, $mode = null, $description = '', $default = null /* array|\Closure $suggestedValues = [] */)
    {
        $suggestedValues = 5 <= \func_num_args() ? func_get_arg(4) : [];
        $this->getCommand()->addArgument($name, $mode, $description, $default, $suggestedValues);

        return $this;
    }

    /**
     * @param array|\Closure(CompletionInput,CompletionSuggestions):list<string|Suggestion> $suggestedValues The values used for input completion
     */
    public function addOption($name, $shortcut = null, $mode = null, $description = '', $default = null /* array|\Closure $suggestedValues = [] */)
    {
        $suggestedValues = 6 <= \func_num_args() ? func_get_arg(5) : [];
        $this->getCommand()->addOption($name, $shortcut, $mode, $description, $default, $suggestedValues);

        return $this;
    }

    public function setProcessTitle($title)
    {
        $this->getCommand()->setProcessTitle($title);

        return $this;
    }

    public function setHelp($help)
    {
        $this->getCommand()->setHelp($help);

        return $this;
    }

    public function getHelp()
    {
        return $this->getCommand()->getHelp();
    }

    public function getProcessedHelp()
    {
        return $this->getCommand()->getProcessedHelp();
    }

    public function getSynopsis($short = false)
    {
        return $this->getCommand()->getSynopsis($short);
    }

    public function addUsage($usage)
    {
        $this->getCommand()->addUsage($usage);

        return $this;
    }

    public function getUsages()
    {
        return $this->getCommand()->getUsages();
    }

    public function getHelper($name)
    {
        return $this->getCommand()->getHelper($name);
    }

    public function getCommand()
    {
        if (!$this->command instanceof \Closure) {
            return $this->command;
        }

        $command = $this->command = ($this->command)();
        $command->setApplication($this->getApplication());

        if (null !== $this->getHelperSet()) {
            $command->setHelperSet($this->getHelperSet());
        }

        $command->setName($this->getName())
            ->setAliases($this->getAliases())
            ->setHidden($this->isHidden())
            ->setDescription($this->getDescription());

        // Will throw if the command is not correctly initialized.
        $command->getDefinition();

        return $command;
    }
}
