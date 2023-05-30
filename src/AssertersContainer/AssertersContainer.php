<?php

declare(strict_types=1);

namespace DDA58\AssertJsonScheme\AssertersContainer;

use DDA58\AssertJsonScheme\Asserter\Dict\DictAsserter;
use DDA58\AssertJsonScheme\Asserter\Dict\DictAsserterInterface;
use DDA58\AssertJsonScheme\Asserter\List\ListAsserter;
use DDA58\AssertJsonScheme\Asserter\List\ListAsserterInterface;
use DDA58\AssertJsonScheme\Asserter\Scalar\NativeScalarAsserter;
use DDA58\AssertJsonScheme\Asserter\Scalar\ScalarAsserterInterface;

class AssertersContainer
{
    private static ?DictAsserterInterface $dictAsserter = null;
    private static ?ListAsserterInterface $listAsserter = null;
    private static ?ScalarAsserterInterface $scalarAsserter = null;

    public static function getDictAsserter(): DictAsserterInterface
    {
        self::$dictAsserter ??= new DictAsserter();

        return self::$dictAsserter;
    }

    public static function getListAsserter(): ListAsserterInterface
    {
        self::$listAsserter ??= new ListAsserter();

        return self::$listAsserter;
    }

    public static function getScalarAsserter(): ScalarAsserterInterface
    {
        self::$scalarAsserter ??= new NativeScalarAsserter();

        return self::$scalarAsserter;
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
