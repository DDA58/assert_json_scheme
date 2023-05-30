<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\RootNode;

use DDA58\AssertJsonScheme\Node\NamelessNodeInterface;
use DDA58\AssertJsonScheme\RootNode\RootListNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class RootListNodeUnitTest extends AbstractUnitTest
{
    private RootListNode $node;

    public function testSuccessAssert(): void
    {
        $this->node->assert([]);

        self::expectNotToPerformAssertions();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new RootListNode(
            $this->createMock(NamelessNodeInterface::class)
        );
    }
}
