<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Node;

interface NamedNodeInterface extends AssertableNodeInterface
{
    public function getName(): string;
}
