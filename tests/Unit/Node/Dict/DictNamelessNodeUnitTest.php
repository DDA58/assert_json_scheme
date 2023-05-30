<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\Dict;

use DDA58\AssertJsonScheme\Node\Dict\DictNamelessNode;
use DDA58\AssertJsonScheme\Node\NamedNodeInterface;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class DictNamelessNodeUnitTest extends AbstractUnitTest
{
    private bool $required;
    private bool $nullable;

    private DictNamelessNode $node;

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

        $this->node = new DictNamelessNode(
            [$this->createMock(NamedNodeInterface::class)],
            $this->required,
            $this->nullable
        );
    }
}
