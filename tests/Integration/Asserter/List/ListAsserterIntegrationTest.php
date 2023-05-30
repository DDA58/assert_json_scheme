<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Integration\Asserter\List;

use DDA58\AssertJsonScheme\Asserter\List\ListAsserter;
use DDA58\AssertJsonScheme\Asserter\List\ListAsserterInterface;
use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use DDA58\AssertJsonScheme\Node\Scalar\BoolNamelessNode;
use DDA58\AssertJsonScheme\Node\Scalar\FloatNamelessNode;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class ListAsserterIntegrationTest extends TestCase
{
    private const IS_NOT_ARRAY_MESSAGE = '[ListAsserter] Value "%s" is not array';
    private const IS_NOT_LIST_MESSAGE = '[ListAsserter] Array "%s" is not list';

    private ListAsserter $asserter;

    public function testSuccessInstanceOf(): void
    {
        self::assertInstanceOf(
            ListAsserterInterface::class,
            $this->asserter
        );
    }

    public function testSuccessAssert(): void
    {
        $this->asserter->assert(
            new FloatNamelessNode(),
            [Factory::create()->randomFloat()]
        );

        self::expectNotToPerformAssertions();
    }

    /**
     * @dataProvider failAssertDataProvider
     */
    public function testFailAssert(
        AssertableNodeInterface $node,
        mixed $value,
        string $expectedExceptionMessage
    ): void {
        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage($expectedExceptionMessage);

        $this->asserter->assert($node, $value);
    }

    public function failAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        $value = $faker->sentence();

        yield 'Value is not array' => [
            new BoolNamelessNode(),
            $value,
            sprintf(self::IS_NOT_ARRAY_MESSAGE, var_export($value, true))
        ];

        $value = [$faker->word() => $faker->sentence()];

        yield 'Array is not list' => [
            new BoolNamelessNode(),
            $value,
            sprintf(self::IS_NOT_LIST_MESSAGE, var_export($value, true))
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->asserter = new ListAsserter();
    }
}
