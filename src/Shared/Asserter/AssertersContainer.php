<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\Shared\Asserter;

use DDA58\AssertJsonScheme\Dict\Asserter\DictAsserter;
use DDA58\AssertJsonScheme\Dict\Asserter\DictAsserterInterface;
use DDA58\AssertJsonScheme\List\Asserter\ListAsserter;
use DDA58\AssertJsonScheme\List\Asserter\ListAsserterInterface;
use DDA58\AssertJsonScheme\Scalar\Asserter\PhpUnitScalarAsserter;
use DDA58\AssertJsonScheme\Scalar\Asserter\ScalarAsserterInterface;

class AssertersContainer
{
    private static ?DictAsserterInterface $dictAsserter = null;
    private static ?ListAsserterInterface $listAsserter = null;
    private static ?ScalarAsserterInterface $scalarAsserter = null;

    public static function getDictAsserter(): DictAsserterInterface
    {
        return self::$dictAsserter ?? new DictAsserter();
    }

    public static function getListAsserter(): ListAsserterInterface
    {
        return self::$listAsserter ?? new ListAsserter();
    }

    public static function getScalarAsserter(): ScalarAsserterInterface
    {
        return self::$scalarAsserter ?? new PhpUnitScalarAsserter();
    }

    public static function setDictAsserter(?DictAsserterInterface $dictAsserter): void
    {
        self::$dictAsserter = $dictAsserter;
    }

    public static function setListAsserter(?ListAsserterInterface $listAsserter): void
    {
        self::$listAsserter = $listAsserter;
    }

    public static function setScalarAsserter(?ScalarAsserterInterface $scalarAsserter): void
    {
        self::$scalarAsserter = $scalarAsserter;
    }
}
