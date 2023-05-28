<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Dict\Asserter;

use DDA58\AssertJsonScheme\Shared\Asserter\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Shared\Node\NamedNodeInterface;

interface DictAsserterInterface
{
    /**
     * @param NamedNodeInterface[] $nodes
     *
     * @throws AssertFailedException
     */
    public function assert(array $nodes, $value): void;
}
