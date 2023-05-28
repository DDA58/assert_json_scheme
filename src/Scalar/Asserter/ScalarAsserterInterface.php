<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Scalar\Asserter;

use DDA58\AssertJsonScheme\Shared\Asserter\Exception\AssertFailedException;

interface ScalarAsserterInterface
{
    /**
     * @throws AssertFailedException
     */
    public function assertString($value): void;

    /**
     * @throws AssertFailedException
     */
    public function assertInt($value): void;

    /**
     * @throws AssertFailedException
     */
    public function assertFloat($value): void;

    /**
     * @throws AssertFailedException
     */
    public function assertBool($value): void;
}
