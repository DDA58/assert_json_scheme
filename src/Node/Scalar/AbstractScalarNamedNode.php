<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\Scalar;

use DDA58\AssertJsonScheme\Node\NamedNodeInterface;

abstract class AbstractScalarNamedNode implements NamedNodeInterface
{
    public function __construct(
        protected string $name,
        protected bool $required = true,
        protected bool $nullable = false
    ) {
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
