<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Scalar\Asserter;

use PHPUnit\Framework\Assert;

class PhpUnitScalarAsserter implements ScalarAsserterInterface
{
    public function assertString($value): void
    {
        Assert::assertIsString($value);
    }

    public function assertInt($value): void
    {
        Assert::assertIsInt($value);
    }

    public function assertFloat($value): void
    {
        Assert::assertIsFloat($value);
    }

    public function assertBool($value): void
    {
        Assert::assertIsBool($value);
    }
}
