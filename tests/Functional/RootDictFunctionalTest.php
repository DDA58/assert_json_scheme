<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Functional;

use DDA58\AssertJsonScheme\Exception\AssertFailedException;
use DDA58\AssertJsonScheme\Node\Dict\DictNamedNode;
use DDA58\AssertJsonScheme\Node\Dict\DictNamedNodeWithKeysAssertion;
use DDA58\AssertJsonScheme\Node\Dict\DictNamelessNode;
use DDA58\AssertJsonScheme\Node\List\ListNamedNode;
use DDA58\AssertJsonScheme\Node\List\ListNamelessNode;
use DDA58\AssertJsonScheme\Node\Scalar\BoolNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\IntNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\StringNamedNode;
use DDA58\AssertJsonScheme\Node\Scalar\StringNamelessNode;
use DDA58\AssertJsonScheme\RootNode\RootDictNode;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

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

        self::expectNotToPerformAssertions();
    }

    public function successAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        yield 'First case' => [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new BoolNamedNode('boolResultTwo'),
                new StringNamedNode('phone'),
                new StringNamedNode('mail'),
                new ListNamedNode(
                    'phonesList',
                    new DictNamelessNode([
                        new StringNamedNode('type'),
                        new StringNamedNode('number'),
                    ])
                ),
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
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield 'Second case' => [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name'),
                            new ListNamedNode('values', new ListNamelessNode(new StringNamelessNode())),
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
                new ListNamedNode('listOfStrings', new StringNamelessNode()),
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
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield 'First nullable case' => [
            new RootDictNode(
                [new BoolNamedNode('bool', true, true)]
            ),
            json_encode(['bool' => null]),
        ];

        yield 'Second nullable case' => [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name', true, true),
                            new ListNamedNode('values', new ListNamelessNode(new StringNamelessNode()), true, true),
                        ])
                    ),
                ]),
            ]),
            json_encode([
                'boolResult' => $faker->boolean(),
                'bigDict' => [
                    'listOfObjectsOne' => [
                        [
                            'id' => $faker->randomNumber(),
                            'name' => null,
                            'values' => null,
                        ],
                    ],
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield 'First not required case' => [
            new RootDictNode(
                [new BoolNamedNode('bool', false)]
            ),
            json_encode([]),
        ];

        yield 'Second not required case' => [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name', false),
                            new ListNamedNode('values', new ListNamelessNode(new StringNamelessNode()), false),
                        ])
                    ),
                ]),
            ]),
            json_encode([
                'boolResult' => $faker->boolean(),
                'bigDict' => [
                    'listOfObjectsOne' => [
                        [
                            'id' => $faker->randomNumber(),
                        ],
                    ],
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield 'Not required and nullable case' => [
            new RootDictNode([
                new BoolNamedNode('boolResult'),
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name', true, true),
                            new ListNamedNode('values', new ListNamelessNode(new StringNamelessNode()), false),
                        ])
                    ),
                ]),
            ]),
            json_encode([
                'boolResult' => $faker->boolean(),
                'bigDict' => [
                    'listOfObjectsOne' => [
                        [
                            'id' => $faker->randomNumber(),
                            'name' => null,
                        ],
                    ],
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];
    }

    /**
     * @dataProvider failAssertDataProvider
     */
    public function testFailAssert(
        RootDictNode $root,
        string $json
    ): void {
        self::expectException(AssertFailedException::class);

        $root->assert(json_decode($json, true));
    }

    public function failAssertDataProvider(): iterable
    {
        $faker = Factory::create();

        yield 'Key is not exist' => [
            new RootDictNode([
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name'),
                        ])
                    ),
                ]),
            ]),
            json_encode([
                'bigDict' => [
                    'listOfObjectsOne' => [
                        [
                            'id' => $faker->randomNumber(),
                        ],
                    ],
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];

        yield 'Value in not valid' => [
            new RootDictNode([
                new DictNamedNode('bigDict', [
                    new ListNamedNode(
                        'listOfObjectsOne',
                        new DictNamelessNode([
                            new IntNamedNode('id'),
                            new StringNamedNode('name'),
                        ])
                    ),
                ]),
            ]),
            json_encode([
                'bigDict' => [
                    'listOfObjectsOne' => [
                        [
                            'id' => $faker->randomNumber(),
                            'name' => $faker->randomNumber(),
                        ],
                    ],
                ],
            ], JSON_PRESERVE_ZERO_FRACTION),
        ];
    }
}
