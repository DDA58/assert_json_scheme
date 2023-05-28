<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Dict\Node;

use DDA58\AssertJsonScheme\Shared\Node\NamedNodeInterface;

class DictNamedNode extends DictNamelessNode implements NamedNodeInterface
{
    private string $name;

    public function __construct(
        string $name,
        array $nodes,
        bool $required = true,
        bool $nullable = false
    ) {
        $this->name = $name;

        parent::__construct($nodes, $required, $nullable);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
