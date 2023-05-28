<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Functional;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use DDA58\AssertJsonScheme\Dict\Node\DictNamedNode;
use DDA58\AssertJsonScheme\Dict\Node\DictNamedNodeWithKeysAssertion;
use DDA58\AssertJsonScheme\Dict\Node\DictNamelessNode;
use DDA58\AssertJsonScheme\List\Node\ListNamedNode;
use DDA58\AssertJsonScheme\List\Node\ListNamelessNode;
use DDA58\AssertJsonScheme\Root\Node\RootDictNode;
use DDA58\AssertJsonScheme\Scalar\Node\BoolNamedNode;
use DDA58\AssertJsonScheme\Scalar\Node\IntNamedNode;
use DDA58\AssertJsonScheme\Scalar\Node\StringNamedNode;
use DDA58\AssertJsonScheme\Scalar\Node\StringNamelessNode;

class RootDictFunctionalTest extends TestCase
{
    /**
     * @dataProvider successAssertDataProvider
     */
    public function testSuccessAssert(
        RootDictNode $root,
        string $json
    ): void {
        $root->assert(json_decode($json, true));
    }

    public function successAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        yield [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new BoolNamedNode('boolResultTwo'),
                new StringNamedNode('phone'),
                new StringNamedNode('mail'),
                new ListNamedNode('phonesList', new DictNamelessNode([
                    new StringNamedNode('type'),
                    new StringNamedNode('number')
                ])),
                new StringNamedNode('forumLink'),
                new BoolNamedNode('boolResultThreeFour'),

            ]),
            json_encode([
                'boolResult' => $faker->boolean(),
                'boolResultTwo' => $faker->boolean(),
                'phone' => $faker->phoneNumber(),
                'mail' => $faker->email(),
                'phonesList' => [
                    [
                        'type' => $faker->word(),
                        'number' => $faker->phoneNumber(),
                    ],
                ],
                'forumLink' => '',
                'boolResultThreeFour' => $faker->boolean(),
            ])
        ];

        yield [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name'),
                            new ListNamedNode('values', new ListNamelessNode(new StringNamelessNode()))
                        ])
                    ),
                    new ListNamedNode(
                        'listOfObjectsOneTwo',
                        new DictNamelessNode([
                            new StringNamedNode('name'),
                            new ListNamedNode('list', new StringNamelessNode()),
                            new StringNamedNode('string'),
                        ])
                    ),
                    new BoolNamedNode('bool'),
                ]),
                new DictNamedNodeWithKeysAssertion(
                    'smallDict',
                    new DictNamelessNode([
                        new StringNamedNode('keyOne'),
                        new BoolNamedNode('keyTwo'),
                        new StringNamedNode('keyThree'),
                    ]),
                    new StringNamelessNode()
                ),
                new ListNamedNode('listOfStrings', new StringNamelessNode())
            ]),
            json_encode([
                'boolResult' => $faker->boolean(),
                'listOfStrings' => [
                    $faker->sentence(),
                    $faker->sentence(),
                ],
                'bigDict' => [
                    'listOfObjectsOne' => [
                        [
                            'id' => $faker->randomNumber(),
                            'name' => $faker->sentence(),
                            'values' => [
                                [
                                    $faker->word(),
                                    $faker->word(),
                                ],
                            ],
                        ],
                    ],
                    'listOfObjectsOneTwo' => [
                        [
                            'name' => $faker->word(),
                            'list' => [
                                $faker->word(),
                            ],
                            'string' => $faker->word(),
                        ],
                        [
                            'name' => $faker->word(),
                            'list' => [
                                $faker->word(),
                            ],
                            'string' => $faker->word(),
                        ],
                    ],
                    'bool' => $faker->boolean(),
                ],
                'smallDict' => [
                    'key' => [
                        'keyOne' => $faker->word(),
                        'keyTwo' => $faker->boolean(),
                        'keyThree' => $faker->word(),
                    ],
                ],
            ])
        ];
    }
}
