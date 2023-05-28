<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Scalar\Node;

use DDA58\AssertJsonScheme\Shared\Asserter\AssertersContainer;
use DDA58\AssertJsonScheme\Shared\Node\ScalarNamelessNodeInterface;

class BoolNamelessNode implements ScalarNamelessNodeInterface
{
    protected bool $required;
    protected bool $nullable;

    public function __construct(
        bool $required = true,
        bool $nullable = false
    ) {
        $this->required = $required;
        $this->nullable = $nullable;
    }

    public function assert($data): void
    {
        AssertersContainer::getScalarAsserter()->assertBool($data);
    }
}
