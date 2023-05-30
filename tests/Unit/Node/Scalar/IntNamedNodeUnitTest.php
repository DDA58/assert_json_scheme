<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\Scalar;

use DDA58\AssertJsonScheme\Node\Scalar\IntNamedNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class IntNamedNodeUnitTest extends AbstractUnitTest
{
    private string $name;
    private bool $required;
    private bool $nullable;

    private IntNamedNode $node;

    public function testSuccessGetters(): void
    {
        self::assertSame($this->name, $this->node->getName());
        self::assertSame($this->required, $this->node->isRequired());
        self::assertSame($this->nullable, $this->node->isNullable());
    }

    public function testSuccessAssert(): void
    {
        $this->node->assert($this->faker->randomNumber());

        self::expectNotToPerformAssertions();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->name = $this->faker->word();
        $this->required = $this->faker->boolean();
        $this->nullable = $this->faker->boolean();

        $this->node = new IntNamedNode(
            $this->name,
            $this->required,
            $this->nullable
        );
    }
}
