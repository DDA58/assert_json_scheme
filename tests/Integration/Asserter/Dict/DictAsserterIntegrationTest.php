<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Integration\Asserter\Dict;

use DDA58\AssertJsonScheme\Asserter\Dict\DictAsserter;
use DDA58\AssertJsonScheme\Asserter\Dict\DictAsserterInterface;
use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\Scalar\BoolNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\StringNamedNode;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class DictAsserterIntegrationTest extends TestCase
{
    private const IS_NOT_ARRAY_MESSAGE = '[DictAsserter] Value "%s" is not array';
    private const IS_NOT_DICT_MESSAGE = '[DictAsserter] Array "%s" is not dict';
    private const REQUIRED_KEYS_NOT_ASSERTED_MESSAGE = '[DictAsserter] Required keys "%s" of dict "%s" don`t asserted';

    private DictAsserter $asserter;

    public function testSuccessInstanceOf(): void
    {
        self::assertInstanceOf(
            DictAsserterInterface::class,
            $this->asserter
        );
    }

    /**
     * @dataProvider successAssertDataProvider
     */
    public function testSuccessAssert(
        array $nodes,
        array $value
    ): void {
        $this->asserter->assert($nodes, $value);

        self::expectNotToPerformAssertions();
    }

    public function successAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        $name = $faker->word();
        $nameTwo = $faker->word();

        yield 'Required and not nullable assert' => [
            [
                new StringNamedNode($name),
                new StringNamedNode($nameTwo),
            ],
            [
                $name => $faker->sentence(),
                $nameTwo => $faker->sentence(),
            ],
        ];

        yield 'Required and nullable assert' => [
            [
                new StringNamedNode($name),
                new StringNamedNode($nameTwo, true, true),
            ],
            [
                $name => $faker->sentence(),
                $nameTwo => null,
            ],
        ];

        yield 'Not required and not nullable assert' => [
            [
                new StringNamedNode($name),
                new StringNamedNode($faker->word(), false),
            ],
            [$name => $faker->sentence()]
        ];

        yield 'Not required and nullable assert' => [
            [
                new StringNamedNode($name),
                new StringNamedNode($nameTwo, false, true),
            ],
            [
                $name => $faker->sentence(),
            ],
        ];
    }

    /**
     * @dataProvider failAssertDataProvider
     */
    public function testFailAssert(
        array $nodes,
        mixed $value,
        string $expectedExceptionMessage
    ): void {
        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage($expectedExceptionMessage);

        $this->asserter->assert($nodes, $value);
    }

    public function failAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        $value = $faker->sentence();

        yield 'Value is not array' => [
            [],
            $value,
            sprintf(self::IS_NOT_ARRAY_MESSAGE, var_export($value, true))
        ];

        $value = [$faker->sentence()];

        yield 'Value is not dict' => [
            [],
            $value,
            sprintf(self::IS_NOT_DICT_MESSAGE, var_export($value, true))
        ];

        $name = $faker->word();
        $value = [$faker->word() => $faker->word()];

        yield 'Required keys don`t asserted' => [
            [new BoolNamedNode($name)],
            $value,
            sprintf(
                self::REQUIRED_KEYS_NOT_ASSERTED_MESSAGE,
                implode(',', [$name]),
                var_export($value, true)
            ),
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->asserter = new DictAsserter();
    }
}
