<?php

namespace Ramsey\Collection;

/**
 * Collection sorting
 */
enum Sort: string
{
    /**
     * Sort items in a collection in ascending order.
     */
    case Ascending = 'asc';

    /**
     * Sort items in a collection in descending order.
     */
    case Descending = 'desc';
}
