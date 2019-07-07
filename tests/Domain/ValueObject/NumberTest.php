<?php

declare(strict_types=1);

namespace Test\Rtb\Population\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Rtb\Population\Domain\ValueObject\Number;

final class NumberTest extends TestCase
{
    public function testFromString(): void
    {
        $number = '123,456,789';

        $this->assertEquals(123456789, Number::fromString($number)->value());
    }
}
