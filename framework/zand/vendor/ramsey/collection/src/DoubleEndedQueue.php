<?php

namespace Ramsey\Collection;

use Ramsey\Collection\Exception\InvalidArgumentException;
use Ramsey\Collection\Exception\NoSuchElementException;

use function array_key_last;
use function array_pop;
use function array_unshift;

/**
 * This class provides a basic implementation of `DoubleEndedQueueInterface`, to
 * minimize the effort required to implement this interface.
 *
 * @template T
 * @extends Queue<T>
 * @implements DoubleEndedQueueInterface<T>
 */
class DoubleEndedQueue extends Queue implements DoubleEndedQueueInterface
{
    /**
     * Constructs a double-ended queue (dequeue) object of the specified type,
     * optionally with the specified data.
     *
     * @param string $queueType The type or class name associated with this dequeue.
     * @param array<array-key, T> $data The initial items to store in the dequeue.
     */
    public function __construct(private readonly $queueType, $data = [])
    {
        parent::__construct($this->queueType, $data);
    }

    /**
     * @throws InvalidArgumentException if $element is of the wrong type
     */
    public function addFirst($element)
    {
        if ($this->checkType($this->getType(), $element) === false) {
            throw new InvalidArgumentException(
                'Value must be of type ' . $this->getType() . '; value is '
                . $this->toolValueToString($element),
            );
        }

        array_unshift($this->data, $element);

        return true;
    }

    /**
     * @throws InvalidArgumentException if $element is of the wrong type
     */
    public function addLast($element)
    {
        return $this->add($element);
    }

    public function offerFirst($element)
    {
        try {
            return $this->addFirst($element);
        } catch (InvalidArgumentException) {
            return false;
        }
    }

    public function offerLast($element)
    {
        return $this->offer($element);
    }

    /**
     * @return T the first element in this queue.
     *
     * @throws NoSuchElementException if the queue is empty
     */
    public function removeFirst()
    {
        return $this->remove();
    }

    /**
     * @return T the last element in this queue.
     *
     * @throws NoSuchElementException if this queue is empty.
     */
    public function removeLast()
    {
        return $this->pollLast() ?? throw new NoSuchElementException(
            'Can\'t return element from Queue. Queue is empty.',
        );
    }

    /**
     * @return T | null the head of this queue, or `null` if this queue is empty.
     */
    public function pollFirst()
    {
        return $this->poll();
    }

    /**
     * @return T | null the tail of this queue, or `null` if this queue is empty.
     */
    public function pollLast()
    {
        return array_pop($this->data);
    }

    /**
     * @return T the head of this queue.
     *
     * @throws NoSuchElementException if this queue is empty.
     */
    public function firstElement()
    {
        return $this->element();
    }

    /**
     * @return T the tail of this queue.
     *
     * @throws NoSuchElementException if this queue is empty.
     */
    public function lastElement()
    {
        return $this->peekLast() ?? throw new NoSuchElementException(
            'Can\'t return element from Queue. Queue is empty.',
        );
    }

    /**
     * @return T | null the head of this queue, or `null` if this queue is empty.
     */
    public function peekFirst()
    {
        return $this->peek();
    }

    /**
     * @return T | null the tail of this queue, or `null` if this queue is empty.
     */
    public function peekLast()
    {
        $lastIndex = array_key_last($this->data);

        if ($lastIndex === null) {
            return null;
        }

        return $this->data[$lastIndex];
    }
}
