<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\RootNode;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\NamelessNodeInterface;

class RootListNode implements RootNodeInterface
{
    public function __construct(
        private NamelessNodeInterface $node
    ) {
    }

    public function assert(array $data): void
    {
        try {
            AssertersContainer::getListAsserter()->assert($this->node, $data);
        } catch (AssertFailedException $exception) {
            throw new AssertFailedException($exception->getMessage(), $data, $exception->getCode(), $exception);
        }
    }
}
