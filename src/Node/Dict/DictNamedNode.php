<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\Dict;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;

class DictNamedNode implements NamedNodeInterface
{
    /**
     * @param NamedNodeInterface[] $nodes
     */
    public function __construct(
        private string $name,
        private array $nodes,
        private bool $required = true,
        private bool $nullable = false
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function assert(mixed $data): void
    {
        AssertersContainer::getDictAsserter()->assert($this->nodes, $data);
    }
}
