<?php

namespace Spiral\Logger\Event;

final class LogEvent
{
    public function __construct(
        private readonly $time,
        private readonly $channel,
        private readonly $level,
        private readonly $message,
        private readonly $context = []
    ) {
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getContext()
    {
        return $this->context;
    }
}
