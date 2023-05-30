<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit;

use DDA58\AssertJsonScheme\Asserter\Dict\DictAsserterInterface;
use DDA58\AssertJsonScheme\Asserter\List\ListAsserterInterface;
use DDA58\AssertJsonScheme\Asserter\Scalar\ScalarAsserterInterface;
use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Node\AssertableNodeInterface;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

abstract class AbstractUnitTest extends TestCase
{
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();

        AssertersContainer::setScalarAsserter(new class implements ScalarAsserterInterface {
            public function assertString(mixed $value): void
            {
            }

            public function assertInt(mixed $value): void
            {
            }

            public function assertFloat(mixed $value): void
            {
            }

            public function assertBool(mixed $value): void
            {
            }
        });

        AssertersContainer::setDictAsserter(new class implements DictAsserterInterface {
            public function assert(array $nodes, mixed $value): void
            {
            }
        });

        AssertersContainer::setListAsserter(new class implements ListAsserterInterface {
            public function assert(AssertableNodeInterface $node, mixed $value): void
            {
            }
        });
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        AssertersContainer::setScalarAsserter(null);
        AssertersContainer::setDictAsserter(null);
        AssertersContainer::setListAsserter(null);
    }
}
