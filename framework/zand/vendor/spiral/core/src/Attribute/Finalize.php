<?php

namespace Spiral\Core\Attribute;

/**
 * Define a finalize method for the class.
 *
 * @internal We are testing this feature, it may be changed in the future.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
final class Finalize
{
    public function __construct(
        public $method,
    ) {
    }
}
