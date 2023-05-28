<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Root\Node;

interface RootNodeInterface
{
    public function assert(array $data): void;
}
