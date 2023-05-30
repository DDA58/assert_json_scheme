<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\Dict;

use DDA58\AssertJsonScheme\Node\Dict\DictNamedNode;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class DictNamedNodeUnitTest extends AbstractUnitTest
{
    private string $name;
    private bool $required;
    private bool $nullable;

    private DictNamedNode $node;

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

        $this->node = new DictNamedNode(
            $this->name,
            [$this->createMock(NamedNodeInterface::class)],
            $this->required,
            $this->nullable
        );
    }
}
