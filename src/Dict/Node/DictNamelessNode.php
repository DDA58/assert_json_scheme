<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Dict\Node;

use DDA58\AssertJsonScheme\Shared\Asserter\AssertersContainer;
use DDA58\AssertJsonScheme\Shared\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Shared\Node\NamelessNodeInterface;

class DictNamelessNode implements NamelessNodeInterface
{
    protected array $nodes;
    protected bool $required;
    protected bool $nullable;

    /**
     * @param AssertableNodeInterface[] $nodes
     */
    public function __construct(
        array $nodes,
        bool $required = true,
        bool $nullable = false
    ) {
        $this->nodes = $nodes;
        $this->required = $required;
        $this->nullable = $nullable;
    }

    public function assert($data): void
    {
        AssertersContainer::getDictAsserter()->assert($this->nodes, $data);
    }
}
