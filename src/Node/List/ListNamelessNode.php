<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\List;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Node\NamelessNodeInterface;

class ListNamelessNode implements NamelessNodeInterface
{
    public function __construct(
        private AssertableNodeInterface $node,
        private bool $required = true,
        private bool $nullable = false
    ) {
    }

    public function assert(mixed $data): void
    {
        AssertersContainer::getListAsserter()->assert($this->node, $data);
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }
}
