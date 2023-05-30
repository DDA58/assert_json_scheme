<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\Dict;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\Node\NamelessNodeInterface;

class DictNamelessNode implements NamelessNodeInterface
{
    /**
     * @param NamedNodeInterface[] $nodes
     */
    public function __construct(
        private array $nodes,
        private bool $required = true,
        private bool $nullable = false
    ) {
    }

    public function assert(mixed $data): void
    {
        AssertersContainer::getDictAsserter()->assert($this->nodes, $data);
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
