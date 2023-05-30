<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Asserter\Scalar;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;

interface ScalarAsserterInterface
{
    /**
     * @throws AssertFailedException
     */
    public function assertString(mixed $value): void;

    /**
     * @throws AssertFailedException
     */
    public function assertInt(mixed $value): void;

    /**
     * @throws AssertFailedException
     */
    public function assertFloat(mixed $value): void;

    /**
     * @throws AssertFailedException
     */
    public function assertBool(mixed $value): void;
}
