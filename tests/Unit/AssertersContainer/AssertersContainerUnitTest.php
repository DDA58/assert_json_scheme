<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Tests\Unit\AssertersContainer;

use DDA58\AssertJsonScheme\Asserter\Dict\DictAsserterInterface;
use DDA58\AssertJsonScheme\Asserter\List\ListAsserterInterface;
use DDA58\AssertJsonScheme\Asserter\Scalar\ScalarAsserterInterface;
use DDA58\AssertJsonScheme\AssertersContainer\AssertersContainer;
use DDA58\AssertJsonScheme\Tests\Unit\AbstractUnitTest;

class AssertersContainerUnitTest extends AbstractUnitTest
{
    public function testSuccessGetSetListAsserter(): void
    {
        $listAsserter = $this->createMock(ListAsserterInterface::class);

        AssertersContainer::setListAsserter($listAsserter);

        self::assertSame($listAsserter, AssertersContainer::getListAsserter());
    }

    public function testSuccessGetSetDictAsserter(): void
    {
        $dictAsserter = $this->createMock(DictAsserterInterface::class);

        AssertersContainer::setDictAsserter($dictAsserter);

        self::assertSame($dictAsserter, AssertersContainer::getDictAsserter());
    }

    public function testSuccessGetSetScalarAsserter(): void
    {
        $scalarAsserter = $this->createMock(ScalarAsserterInterface::class);

        AssertersContainer::setScalarAsserter($scalarAsserter);

        self::assertSame($scalarAsserter, AssertersContainer::getScalarAsserter());
    }
}
