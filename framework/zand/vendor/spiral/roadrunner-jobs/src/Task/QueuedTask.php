<?php

namespace Spiral\RoadRunner\Jobs\Task;

/**
 * @psalm-immutable
 * @psalm-allow-private-mutation
 */
class QueuedTask extends Task implements QueuedTaskInterface
{
    /**
     * @var non-empty-string
     */
    protected string $id;

    /**
     * @var non-empty-string
     */
    protected string $queue;

    /**
     * @param non-empty-string $id
     * @param non-empty-string $queue
     * @param non-empty-string $name
     * @param array $payload
     * @param array<non-empty-string, array<string>> $headers
     */
    public function __construct($id, $queue, $name, $payload = [], $headers = [])
    {
        $this->id = $id;
        $this->queue = $queue;

        parent::__construct($name, $payload, $headers);
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function getQueue()
    {
        return $this->queue;
    }
}
