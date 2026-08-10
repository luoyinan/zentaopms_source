<?php

namespace Spiral\Logger;

use Psr\Log\LoggerInterface;
use Spiral\Logger\Event\LogEvent;

/**
 * Routes log information to various listeners.
 */
final class LogFactory implements LogsInterface
{
    public function __construct(
        private readonly $listenedRegistry
    ) {
    }

    public function getLogger($channel)
    {
        return new NullLogger([$this, 'log'], $channel);
    }

    public function log($channel, $level, $message, $context = [])
    {
        $e = new LogEvent(
            new \DateTime(),
            $channel,
            (string) $level,
            $message,
            $context
        );

        foreach ($this->listenedRegistry->getListeners() as $listener) {
            \call_user_func($listener, $e);
        }
    }
}
