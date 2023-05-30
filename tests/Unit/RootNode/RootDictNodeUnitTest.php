<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\RootNode;

use DDA58\AssertJsonScheme\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\RootNode\Exception\InvalidArgumentException;
use DDA58\AssertJsonScheme\RootNode\RootDictNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class RootDictNodeUnitTest extends AbstractUnitTest
{
    private const INVALID_ARGUMENT_EXCEPTION_MESSAGE = '[RootDictNode] Node is not instance of NamedNodeInterface';

    private RootDictNode $node;

    public function testSuccessAssert(): void
    {
        $this->node->assert([]);

        self::expectNotToPerformAssertions();
    }

    public function testFailCreateNodeWhenNodesNotValid(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage(self::INVALID_ARGUMENT_EXCEPTION_MESSAGE);

        new RootDictNode([
            (object)[]
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->node = new RootDictNode([
            $this->createMock(NamedNodeInterface::class)
        ]);
    }
}
