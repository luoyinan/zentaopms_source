<?php

namespace Ramsey\Uuid\Converter\Number;

use Ramsey\Uuid\Converter\NumberConverterInterface;
use Ramsey\Uuid\Math\CalculatorInterface;
use Ramsey\Uuid\Type\Integer as IntegerObject;

/**
 * GenericNumberConverter uses the provided calculator to convert decimal
 * numbers to and from hexadecimal values
 *
 * @psalm-immutable
 */
class GenericNumberConverter implements NumberConverterInterface
{
    public function __construct(private $calculator)
    {
    }

    /**
     * @inheritDoc
     * @psalm-pure
     * @psalm-return numeric-string
     * @psalm-suppress MoreSpecificReturnType we know that the retrieved `string` is never empty
     * @psalm-suppress LessSpecificReturnStatement we know that the retrieved `string` is never empty
     */
    public function fromHex($hex)
    {
        return $this->calculator->fromBase($hex, 16)->toString();
    }

    /**
     * @inheritDoc
     * @psalm-pure
     * @psalm-return non-empty-string
     * @psalm-suppress MoreSpecificReturnType we know that the retrieved `string` is never empty
     * @psalm-suppress LessSpecificReturnStatement we know that the retrieved `string` is never empty
     */
    public function toHex($number)
    {
        /** @phpstan-ignore-next-line PHPStan complains that this is not a non-empty-string. */
        return $this->calculator->toBase(new IntegerObject($number), 16);
    }
}
