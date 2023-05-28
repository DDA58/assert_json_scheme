<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\List\Node;

use DDA58\AssertJsonScheme\Shared\Asserter\AssertersContainer;
use DDA58\AssertJsonScheme\Shared\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Shared\Node\NamelessNodeInterface;

class ListNamelessNode implements NamelessNodeInterface
{
    protected bool $required;
    protected bool $nullable;
    protected AssertableNodeInterface $node;

    public function __construct(
        AssertableNodeInterface $node,
        bool $required = true,
        bool $nullable = false
    ) {
        $this->node = $node;
        $this->required = $required;
        $this->nullable = $nullable;
    }

    public function assert($data): void
    {
        AssertersContainer::getListAsserter()->assert($this->node, $data);
    }
}
