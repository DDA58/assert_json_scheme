<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\List\Asserter;

use DDA58\AssertJsonScheme\Shared\Asserter\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Shared\Node\AssertableNodeInterface;

interface ListAsserterInterface
{
    /**
     * @throws AssertFailedException
     */
    public function assert(AssertableNodeInterface $node, $value): void;
}
