<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Root\Node;

use DDA58\AssertJsonScheme\Root\Node\Exception\InvalidArgumentException;
use DDA58\AssertJsonScheme\Shared\Asserter\AssertersContainer;
use DDA58\AssertJsonScheme\Shared\Node\NamedNodeInterface;

class RootDictNode implements RootNodeInterface
{
    private const INVALID_ARGUMENT_EXCEPTION_MESSAGE = '[RootDictNode] Node is not instance of NamedNodeInterface';

    private array $nodes;

    /**
     * @param NamedNodeInterface[] $nodes
     */
    public function __construct(
        array $nodes
    ) {
        foreach ($nodes as $node) {
            if ($node instanceof NamedNodeInterface === false) {
                throw new InvalidArgumentException(self::INVALID_ARGUMENT_EXCEPTION_MESSAGE);
            }
        }

        $this->nodes = $nodes;
    }

    public function assert(array $data): void
    {
        AssertersContainer::getDictAsserter()->assert($this->nodes, $data);
    }
}
