<?php

namespace Brick\Math\Internal\Calculator;

use Brick\Math\Internal\Calculator;

/**
 * Calculator implementation built around the bcmath library.
 *
 * @internal
 *
 * @psalm-immutable
 */
class BcMathCalculator extends Calculator
{
    public function add($a, $b)
    {
        return \bcadd($a, $b, 0);
    }

    public function sub($a, $b)
    {
        return \bcsub($a, $b, 0);
    }

    public function mul($a, $b)
    {
        return \bcmul($a, $b, 0);
    }

    public function divQ($a, $b)
    {
        return \bcdiv($a, $b, 0);
    }

    /**
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     */
    public function divR($a, $b)
    {
        return \bcmod($a, $b, 0);
    }

    public function divQR($a, $b)
    {
        $q = \bcdiv($a, $b, 0);
        $r = \bcmod($a, $b, 0);

        assert($r !== null);

        return [$q, $r];
    }

    public function pow($a, $e)
    {
        return \bcpow($a, (string) $e, 0);
    }

    public function modPow($base, $exp, $mod)
    {
        return \bcpowmod($base, $exp, $mod, 0);
    }

    /**
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     */
    public function sqrt($n)
    {
        return \bcsqrt($n, 0);
    }
}
