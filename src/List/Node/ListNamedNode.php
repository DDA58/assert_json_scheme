<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\List\Node;

use DDA58\AssertJsonScheme\Shared\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Shared\Node\NamedNodeInterface;

class ListNamedNode extends ListNamelessNode implements NamedNodeInterface
{
    private string $name;

    public function __construct(
        string $name,
        AssertableNodeInterface $node,
        bool $required = true,
        bool $nullable = false
    ) {
        $this->name = $name;

        parent::__construct($node, $required, $nullable);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
