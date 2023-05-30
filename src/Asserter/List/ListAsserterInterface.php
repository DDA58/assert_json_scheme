<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Asserter\List;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;

interface ListAsserterInterface
{
    /**
     * @throws AssertFailedException
     */
    public function assert(AssertableNodeInterface $node, mixed $value): void;
}
