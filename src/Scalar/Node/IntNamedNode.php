<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Scalar\Node;

use DDA58\AssertJsonScheme\Shared\Node\NamedNodeInterface;

class IntNamedNode extends IntNamelessNode implements NamedNodeInterface
{
    private string $name;

    public function __construct(
        string $name,
        bool $required = true,
        bool $nullable = false
    ) {
        $this->name = $name;

        parent::__construct($required, $nullable);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
