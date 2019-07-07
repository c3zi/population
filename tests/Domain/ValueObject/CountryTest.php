<?php

declare(strict_types=1);

namespace Test\Rtb\Population\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Rtb\Population\Domain\ValueObject\Country;

final class CountryTest extends TestCase
{
    public function testWhenUnsupportedCharacters(): void
    {
        $countryName = " CHINA\t\n";
        $country = new Country($countryName);

        $this->assertEquals('China', $country->toString());
        $this->assertEquals('china', $country->name());
    }
}
