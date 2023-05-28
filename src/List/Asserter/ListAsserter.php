<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\List\Asserter;

use DDA58\AssertJsonScheme\Shared\Asserter\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Shared\Node\AssertableNodeInterface;

class ListAsserter implements ListAsserterInterface
{
    public function assert(AssertableNodeInterface $node, $value): void
    {
        if (is_array($value) === false) {
            throw new AssertFailedException(sprintf('[ListAsserter] %s is not array', $value));
        }

        if (array_is_list($value) === false) {
            throw new AssertFailedException(sprintf('[ListAsserter] Array %s is not list', var_export($value, true)));
        }

        foreach ($value as $item) {
            $node->assert($item);
        }
    }
}
