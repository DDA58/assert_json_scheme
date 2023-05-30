<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Asserter\Dict;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;

interface DictAsserterInterface
{
    /**
     * @param NamedNodeInterface[] $nodes
     *
     * @throws AssertFailedException
     */
    public function assert(array $nodes, mixed $value): void;
}
