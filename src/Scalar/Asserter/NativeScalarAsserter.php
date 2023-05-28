<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Scalar\Asserter;

use DDA58\AssertJsonScheme\Shared\Asserter\Exception\AssertFailedException;

class NativeScalarAsserter implements ScalarAsserterInterface
{
    private const ASSERT_FAILED_MESSAGE = '[NativeScalarAsserter] Value "%s" is not %s';

    public function assertString($value): void
    {
        if (is_string($value) === false) {
            throw new AssertFailedException(sprintf(self::ASSERT_FAILED_MESSAGE, $value, 'string'));
        }
    }

    public function assertInt($value): void
    {
        if (is_int($value) === false) {
            throw new AssertFailedException(sprintf(self::ASSERT_FAILED_MESSAGE, $value, 'int'));
        }
    }

    public function assertFloat($value): void
    {
        if (is_float($value) === false) {
            throw new AssertFailedException(sprintf(self::ASSERT_FAILED_MESSAGE, $value, 'float'));
        }
    }

    public function assertBool($value): void
    {
        if (is_bool($value) === false) {
            throw new AssertFailedException(sprintf(self::ASSERT_FAILED_MESSAGE, $value, 'bool'));
        }
    }
}
