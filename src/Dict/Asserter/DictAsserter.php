<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Dict\Asserter;

use DDA58\AssertJsonScheme\Shared\Asserter\Exception\AssertFailedException;

class DictAsserter implements DictAsserterInterface
{
    public function assert(array $nodes, $value): void
    {
        if (is_array($value) === false) {
            throw new AssertFailedException(sprintf('[DictAsserter] %s is not array', $value));
        }

        $isDict = array_reduce(
            array_keys($value),
            static fn(bool $carry, $item): bool => $carry && is_string($item),
            true
        );

        if ($isDict === false) {
            throw new AssertFailedException(sprintf('[ListAsserter] Array %s is not dict', var_export($value, true)));
        }

        foreach ($value as $key => $item) {
            $isKeyAsserted = false;

            foreach ($nodes as $node) {
                if ($key === $node->getName()) {
                    $node->assert($item);

                    $isKeyAsserted = true;

                    break;
                }
            }

            if ($isKeyAsserted === false) {
                throw new AssertFailedException(sprintf('%s key of data %s not asserted', $key, var_export($value, true)));
            }
        }
    }
}
