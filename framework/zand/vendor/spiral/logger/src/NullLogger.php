<?php

namespace Spiral\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

/**
 * Simply forwards debug messages into various locations.
 */
final class NullLogger implements LoggerInterface
{
    use LoggerTrait;

    private readonly \Closure $receptor;

    public function __construct(
        $receptor,
        private $channel
    ) {
        $this->receptor = $receptor(...);
    }

    public function log($level, $message, $context = [])
    {
        \call_user_func($this->receptor, $this->channel, $level, $message, $context);
    }
}
