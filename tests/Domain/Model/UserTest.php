<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use DateTime;
use PHPUnit\Framework\TestCase;
use Rtb\Population\Domain\ValueObject\Country;

final class UserTest extends TestCase
{
    public function testPercentageOfInternetUserToPopulation(): void
    {
        $user = new User(new Country('China'), 1000, new DateTime(), 100, 5000);

        $this->assertEquals(10, $user->internetUserCountryToPopulationCountry());
    }

    public function testPercentageOfInternetUserToWorldWide(): void
    {
        $user = new User(new Country('China'), 1000, new DateTime(), 100, 5000);

        $this->assertEquals(2, $user->internetUserCountryToWorldWide());
    }

    public function testFormattedPercentages():  void
    {
        $user = new User(new Country('China'), 222222221, new DateTime(), 11111111, 111111111);

        $this->assertEquals('11 111 111', $user->formattedInternetUsers());
        $this->assertEquals('222 222 221', $user->formattedPopulation());

    }
}
