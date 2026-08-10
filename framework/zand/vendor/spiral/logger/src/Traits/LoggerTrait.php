<?php

namespace Spiral\Logger\Traits;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Spiral\Core\ContainerScope;
use Spiral\Logger\LogsInterface;

/**
 * Logger trait provides access to the logger from the global container scope (if exists).
 */
trait LoggerTrait
{
    /** @internal */
    private ?LoggerInterface $logger = null;

    /**
     * Sets a logger.
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * Get associated or create new instance of LoggerInterface.
     */
    protected function getLogger($channel = null)
    {
        if ($channel !== null) {
            return $this->allocateLogger($channel);
        }

        if ($this->logger !== null) {
            return $this->logger;
        }

        //We are using class name as log channel (name) by default
        return $this->logger = $this->allocateLogger(static::class);
    }

    /**
     * Create new instance of associated logger (on demand creation).
     */
    private function allocateLogger($channel)
    {
        $container = ContainerScope::getContainer();
        if (empty($container) || !$container->has(LogsInterface::class)) {
            return $this->logger ?? new NullLogger();
        }

        //We are using class name as log channel (name) by default
        return $container->get(LogsInterface::class)->getLogger($channel);
    }
}
