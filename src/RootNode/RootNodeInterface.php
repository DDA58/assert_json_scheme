<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\RootNode;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;

interface RootNodeInterface
{
    /**
     * @throws AssertFailedException
     */
    public function assert(array $data): void;
}
