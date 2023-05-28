<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Shared\Node;

interface AssertableNodeInterface
{
    public function assert($data): void;
}
