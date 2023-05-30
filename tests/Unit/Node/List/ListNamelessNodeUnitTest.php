<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\List;

use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Node\List\ListNamelessNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class ListNamelessNodeUnitTest extends AbstractUnitTest
{
    private bool $required;
    private bool $nullable;

    private ListNamelessNode $node;

    public function testSuccessGetters(): void
    {
        self::assertSame($this->required, $this->node->isRequired());
        self::assertSame($this->nullable, $this->node->isNullable());
    }

    public function testSuccessAssert(): void
    {
        $this->node->assert($this->faker->sentence());

        self::expectNotToPerformAssertions();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->required = $this->faker->boolean();
        $this->nullable = $this->faker->boolean();

        $this->node = new ListNamelessNode(
            $this->createMock(AssertableNodeInterface::class),
            $this->required,
            $this->nullable
        );
    }
}
