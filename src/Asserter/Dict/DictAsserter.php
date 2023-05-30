<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Asserter\Dict;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;

class DictAsserter implements DictAsserterInterface
{
    private const IS_NOT_ARRAY_MESSAGE = '[DictAsserter] Value "%s" is not array';
    private const IS_NOT_DICT_MESSAGE = '[DictAsserter] Array "%s" is not dict';
    private const REQUIRED_KEYS_NOT_ASSERTED_MESSAGE = '[DictAsserter] Required keys "%s" of dict "%s" don`t asserted';

    public function assert(array $nodes, mixed $value): void
    {
        if (is_array($value) === false) {
            throw new AssertFailedException(
                sprintf(self::IS_NOT_ARRAY_MESSAGE, var_export($value, true)),
                $value
            );
        }

        $isDict = array_reduce(
            array_keys($value),
            static fn(bool $carry, $item): bool => $carry && is_string($item),
            true
        );

        if ($isDict === false) {
            throw new AssertFailedException(
                sprintf(self::IS_NOT_DICT_MESSAGE, var_export($value, true)),
                $value
            );
        }

        $allKeys = [];
        $notRequiredKeys = [];

        foreach ($nodes as $node) {
            $allKeys[] = $node->getName();

            if ($node->isRequired() === false) {
                $notRequiredKeys[] = $node->getName();
            }
        }

        $validatedKeys = [];

        /**
         * @psalm-var array $value
         * @psalm-var mixed $item
         */
        foreach ($value as $key => $item) {
            foreach ($nodes as $node) {
                if ($key !== $node->getName()) {
                    continue;
                }

                if ($item === null && $node->isNullable()) {
                    $validatedKeys[] = $key;

                    break;
                }

                try {
                    $node->assert($item);
                } catch (AssertFailedException $exception) {
                    throw new AssertFailedException(
                        $exception->getMessage(),
                        $item,
                        $exception->getCode(),
                        $exception,
                        $value
                    );
                }

                $validatedKeys[] = $key;

                break;
            }
        }

        $notValidatedKeys = array_diff($allKeys, $validatedKeys, $notRequiredKeys);

        if ($notValidatedKeys !== []) {
            throw new AssertFailedException(
                sprintf(
                    self::REQUIRED_KEYS_NOT_ASSERTED_MESSAGE,
                    implode(',', $notValidatedKeys),
                    var_export($value, true)
                ),
                $value
            );
        }
    }
}
