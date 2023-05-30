<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\RootNode;

use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\RootNode\Exception\InvalidArgumentException;

class RootDictNode implements RootNodeInterface
{
    private const INVALID_ARGUMENT_EXCEPTION_MESSAGE = '[RootDictNode] Node is not instance of NamedNodeInterface';

    /**
     * @param NamedNodeInterface[] $nodes
     *
     * @throws InvalidArgumentException
     */
    public function __construct(
        private array $nodes
    ) {
        foreach ($nodes as $node) {
            if ($node instanceof NamedNodeInterface === false) {
                throw new InvalidArgumentException(self::INVALID_ARGUMENT_EXCEPTION_MESSAGE);
            }
        }
    }

    public function assert(array $data): void
    {
        try {
            AssertersContainer::getDictAsserter()->assert($this->nodes, $data);
        } catch (AssertFailedException $exception) {
            throw new AssertFailedException($exception->getMessage(), $data, $exception->getCode(), $exception);
        }
    }
}
