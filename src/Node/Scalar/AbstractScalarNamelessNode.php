<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\Scalar;

use DDA58\AssertJsonScheme\Node\NamelessNodeInterface;

abstract class AbstractScalarNamelessNode implements NamelessNodeInterface
{
    public function __construct(
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
}
