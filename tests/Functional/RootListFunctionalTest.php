<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Functional;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\Dict\DictNamedNode;
use DDA58\AssertJsonScheme\Node\Dict\DictNamelessNode;
use DDA58\AssertJsonScheme\Node\Scalar\BoolNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\FloatNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\IntNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\StringNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\StringNamelessNode;
use DDA58\AssertJsonScheme\RootNode\RootListNode;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class RootListFunctionalTest extends TestCase
{
    /**
     * @dataProvider successAssertDataProvider
     */
    public function testSuccessAssert(
        RootListNode $root,
        string $json
    ): void {
        $root->assert(json_decode($json, true));

        self::expectNotToPerformAssertions();
    }

    public function successAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        yield [
            new RootListNode(
                new DictNamelessNode([
                    new IntNamedNode('id'),
                    new BoolNamedNode('boolResult'),
                    new StringNamedNode('name'),
                    new DictNamedNode('dict', [
                        new IntNamedNode('int'),
                        new FloatNamedNode('float'),
                    ]),
                ])
            ),
            json_encode([
                [
                    'id' => $faker->randomNumber(),
                    'boolResult' => $faker->boolean(),
                    'name' => $faker->word(),
                    'dict' => [
                        'int' => $faker->randomNumber(),
                        'float' => $faker->randomFloat(),
                    ],
                ],
                [
                    'id' => $faker->randomNumber(),
                    'boolResult' => $faker->boolean(),
                    'name' => $faker->word(),
                    'dict' => [
                        'int' => $faker->randomNumber(),
                        'float' => $faker->randomFloat(),
                    ],
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield [
            new RootListNode(
                new StringNamelessNode(),
            ),
            json_encode([
                $faker->sentence(),
                $faker->sentence(),
                $faker->sentence(),
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];
    }

    /**
     * @dataProvider failAssertDataProvider
     */
    public function testFailAssert(
        RootListNode $root,
        string $json
    ): void {
        self::expectException(AssertFailedException::class);

        $root->assert(json_decode($json, true));
    }

    public function failAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        yield 'Key is not exist' => [
            new RootListNode(
                new DictNamelessNode([
                    new IntNamedNode('id'),
                    new StringNamedNode('name'),
                ]),
            ),
            json_encode([
                [
                    'id' => $faker->randomNumber(),
                    'name' => $faker->word(),
                ],
                [
                    'id' => $faker->randomNumber(),
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield 'Value in not valid' => [
            new RootListNode(
                new DictNamelessNode([
                    new IntNamedNode('id'),
                    new StringNamedNode('name'),
                ]),
            ),
            json_encode([
                [
                    'id' => $faker->randomNumber(),
                    'name' => $faker->word(),
                ],
                [
                    'id' => $faker->word(),
                    'name' => $faker->word(),
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];
    }
}
