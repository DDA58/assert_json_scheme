<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Root\Node;

use DDA58\AssertJsonScheme\Shared\Asserter\AssertersContainer;
use DDA58\AssertJsonScheme\Shared\Node\NamelessNodeInterface;

class RootListNode implements RootNodeInterface
{
    private NamelessNodeInterface $node;

    public function __construct(
        NamelessNodeInterface $node
    ) {
        $this->node = $node;
    }

    public function assert(array $data): void
    {
        AssertersContainer::getListAsserter()->assert($this->node, $data);
    }
}
