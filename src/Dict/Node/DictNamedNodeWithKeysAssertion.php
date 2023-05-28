<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Dict\Node;

use DDA58\AssertJsonScheme\Shared\Asserter\AssertersContainer;
use DDA58\AssertJsonScheme\Shared\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Shared\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\Shared\Node\ScalarNamelessNodeInterface;

class DictNamedNodeWithKeysAssertion implements NamedNodeInterface
{
    private string $name;
    private AssertableNodeInterface $node;
    private ?ScalarNamelessNodeInterface $keyNode;
    private bool $required;
    private bool $nullable;

    public function __construct(
        string $name,
        AssertableNodeInterface $node,
        ?ScalarNamelessNodeInterface $keyNode = null,
        bool $required = true,
        bool $nullable = false
    ) {
        $this->name = $name;
        $this->node = $node;
        $this->keyNode = $keyNode;
        $this->required = $required;
        $this->nullable = $nullable;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function assert($data): void
    {
        $this->keyNode !== null && AssertersContainer::getListAsserter()->assert($this->keyNode, array_keys($data));

        AssertersContainer::getListAsserter()->assert($this->node, array_values($data));
    }
}
