<?php

namespace Ramsey\Uuid\Generator;

use Ramsey\Uuid\Converter\TimeConverterInterface;
use Ramsey\Uuid\Provider\NodeProviderInterface;
use Ramsey\Uuid\Provider\TimeProviderInterface;

/**
 * TimeGeneratorFactory retrieves a default time generator, based on the
 * environment
 */
class TimeGeneratorFactory
{
    public function __construct(
        private $nodeProvider,
        private $timeConverter,
        private $timeProvider
    ) {
    }

    /**
     * Returns a default time generator, based on the current environment
     */
    public function getGenerator()
    {
        return new DefaultTimeGenerator(
            $this->nodeProvider,
            $this->timeConverter,
            $this->timeProvider
        );
    }
}
