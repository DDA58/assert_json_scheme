<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Asserter\Scalar;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;

class NativeScalarAsserter implements ScalarAsserterInterface
{
    private const ASSERT_FAILED_MESSAGE = '[NativeScalarAsserter] Value "%s" is not type of "%s"';

    public function assertString(mixed $value): void
    {
        if (is_string($value) === false) {
            throw new AssertFailedException(
                sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'string'),
                $value
            );
        }
    }

    public function assertInt(mixed $value): void
    {
        if (is_int($value) === false) {
            throw new AssertFailedException(
                sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'int'),
                $value
            );
        }
    }

    public function assertFloat(mixed $value): void
    {
        if (is_float($value) === false) {
            throw new AssertFailedException(
                sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'float'),
                $value
            );
        }
    }

    public function assertBool(mixed $value): void
    {
        if (is_bool($value) === false) {
            throw new AssertFailedException(
                sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'bool'),
                $value
            );
        }
    }
}
