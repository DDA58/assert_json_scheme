<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\List;

use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Node\List\ListNamedNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class ListNamedNodeUnitTest extends AbstractUnitTest
{
    private string $name;
    private bool $required;
    private bool $nullable;

    private ListNamedNode $node;

    public function testSuccessGetters(): void
    {
        self::assertSame($this->name, $this->node->getName());
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

        $this->name = $this->faker->word();
        $this->required = $this->faker->boolean();
        $this->nullable = $this->faker->boolean();

        $this->node = new ListNamedNode(
            $this->name,
            $this->createMock(AssertableNodeInterface::class),
            $this->required,
            $this->nullable
        );
    }
}
