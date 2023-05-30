<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;

interface AssertableNodeInterface
{
    /**
     * @throws AssertFailedException
     * @internal
     */
    public function assert(mixed $data): void;

    /**
     * @internal
     */
    public function isRequired(): bool;

    /**
     * @internal
     */
    public function isNullable(): bool;
}
