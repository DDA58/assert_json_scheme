<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\Scalar;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;

class IntNamedNode extends AbstractScalarNamedNode
{
    public function assert(mixed $data): void
    {
        AssertersContainer::getScalarAsserter()->assertInt($data);
    }
}
