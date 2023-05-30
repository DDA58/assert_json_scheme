<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Integration\Asserter\Scalar;

use DDA58\AssertJsonScheme\Asserter\Scalar\NativeScalarAsserter;
use DDA58\AssertJsonScheme\Asserter\Scalar\ScalarAsserterInterface;
use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class NativeScalarAsserterIntegrationTest extends TestCase
{
    private const ASSERT_FAILED_MESSAGE = '[NativeScalarAsserter] Value "%s" is not type of "%s"';

    private Generator $faker;
    private NativeScalarAsserter $asserter;

    public function testSuccessInstanceOf(): void
    {
        self::assertInstanceOf(
            ScalarAsserterInterface::class,
            $this->asserter
        );
    }

    public function testSuccessAssertString(): void
    {
        $this->asserter->assertString(
            $this->faker->sentence()
        );

        self::expectNotToPerformAssertions();
    }

    public function testFailAssertString(): void
    {
        $value = $this->faker->randomNumber();

        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage(
            sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'string')
        );

        $this->asserter->assertString($value);
    }

    public function testSuccessAssertInt(): void
    {
        $this->asserter->assertInt(
            $this->faker->randomNumber()
        );

        self::expectNotToPerformAssertions();
    }

    public function testFailAssertInt(): void
    {
        $value = $this->faker->randomFloat();

        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage(
            sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'int')
        );

        $this->asserter->assertInt($value);
    }

    public function testSuccessAssertFloat(): void
    {
        $this->asserter->assertFloat(
            $this->faker->randomFloat()
        );

        self::expectNotToPerformAssertions();
    }

    public function testFailAssertFloat(): void
    {
        $value = $this->faker->boolean();

        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage(
            sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'float')
        );

        $this->asserter->assertFloat($value);
    }

    public function testSuccessAssertBool(): void
    {
        $this->asserter->assertBool(
            $this->faker->boolean()
        );

        self::expectNotToPerformAssertions();
    }

    public function testFailAssertBool(): void
    {
        $value = $this->faker->sentence();

        self::expectException(AssertFailedException::class);
        self::expectExceptionMessage(
            sprintf(self::ASSERT_FAILED_MESSAGE, var_export($value, true), 'bool')
        );

        $this->asserter->assertBool($value);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->asserter = new NativeScalarAsserter();
    }
}
