<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node\Dict;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\Node\Scalar\AbstractScalarNamelessNode;

class DictNamedNodeWithKeysAssertion implements NamedNodeInterface
{
    private const IS_NOT_ARRAY_MESSAGE = '[DictNamedNodeWithKeysAssertion] %s is not array';

    public function __construct(
        private string $name,
        private AssertableNodeInterface $node,
        private ?AbstractScalarNamelessNode $keyNode = null,
        private bool $required = true,
        private bool $nullable = false
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function assert(mixed $data): void
    {
        if (is_array($data) === false) {
            throw new AssertFailedException(
                sprintf(self::IS_NOT_ARRAY_MESSAGE, var_export($data, true)),
                $data
            );
        }

        $this->keyNode !== null && AssertersContainer::getListAsserter()->assert($this->keyNode, array_keys($data));

        AssertersContainer::getListAsserter()->assert($this->node, array_values($data));
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
