<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Asserter\List;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;

class ListAsserter implements ListAsserterInterface
{
    private const IS_NOT_ARRAY_MESSAGE = '[ListAsserter] Value "%s" is not array';
    private const IS_NOT_LIST_MESSAGE = '[ListAsserter] Array "%s" is not list';

    public function assert(AssertableNodeInterface $node, mixed $value): void
    {
        if (is_array($value) === false) {
            throw new AssertFailedException(
                sprintf(self::IS_NOT_ARRAY_MESSAGE, var_export($value, true)),
                $value
            );
        }

        if (array_is_list($value) === false) {
            throw new AssertFailedException(
                sprintf(self::IS_NOT_LIST_MESSAGE, var_export($value, true)),
                $value
            );
        }

        /**
         * @psalm-var mixed $item
         */
        foreach ($value as $item) {
            $node->assert($item);
        }
    }
}
