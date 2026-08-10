<?php

namespace Ramsey\Collection;

/**
 * This class contains the basic implementation of a collection that does not
 * allow duplicated values (a set), to minimize the effort required to implement
 * this specific type of collection.
 *
 * @template T
 * @extends AbstractCollection<T>
 */
abstract class AbstractSet extends AbstractCollection
{
    public function add($element)
    {
        if ($this->contains($element)) {
            return false;
        }

        return parent::add($element);
    }

    public function offsetSet(mixed $offset, mixed $value)
    {
        if ($this->contains($value)) {
            return;
        }

        parent::offsetSet($offset, $value);
    }
}
