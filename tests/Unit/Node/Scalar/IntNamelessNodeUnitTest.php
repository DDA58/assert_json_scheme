<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\Scalar;

use DDA58\AssertJsonScheme\Node\Scalar\IntNamelessNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class IntNamelessNodeUnitTest extends AbstractUnitTest
{
    private bool $required;
    private bool $nullable;

    private IntNamelessNode $node;

    public function testSuccessGetters(): void
    {
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

        $this->required = $this->faker->boolean();
        $this->nullable = $this->faker->boolean();

        $this->node = new IntNamelessNode(
            $this->required,
            $this->nullable
        );
    }
}
