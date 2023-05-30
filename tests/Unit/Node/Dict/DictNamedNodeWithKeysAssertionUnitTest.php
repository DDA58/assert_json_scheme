<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\Node\Dict;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Node\Dict\DictNamedNodeWithKeysAssertion;
use DDA58\AssertJsonScheme\Node\Scalar\AbstractScalarNamelessNode;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class DictNamedNodeWithKeysAssertionUnitTest extends AbstractUnitTest
{
    private const IS_NOT_ARRAY_MESSAGE = '[DictNamedNodeWithKeysAssertion] %s is not array';

    private string $name;
    private bool $required;
    private bool $nullable;

    private DictNamedNodeWithKeysAssertion $node;

    public function testSuccessGetters(): void
    {
        self::assertSame($this->name, $this->node->getName());
        self::assertSame($this->required, $this->node->isRequired());
        self::assertSame($this->nullable, $this->node->isNullable());
    }

    public function testSuccessAssert(): void
    {
        $this->node->assert([]);

        self::expectNotToPerformAssertions();
    }

    public function testFailAssertWhenDataIsNotArray(): void
    {
        $data = $this->faker->sentence();

        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage(sprintf(self::IS_NOT_ARRAY_MESSAGE, var_export($data, true)));

        $this->node->assert($data);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->name = $this->faker->word();
        $this->required = $this->faker->boolean();
        $this->nullable = $this->faker->boolean();

        $this->node = new DictNamedNodeWithKeysAssertion(
            $this->name,
            $this->createMock(AssertableNodeInterface::class),
            $this->createMock(AbstractScalarNamelessNode::class),
            $this->required,
            $this->nullable
        );
    }
}
