<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Factory;

use DateTime;
use PHPUnit\Framework\TestCase;
use Rtb\Population\Domain\Model\InternetUser;
use Rtb\Population\Domain\Model\InternetUserCollection;
use Rtb\Population\Domain\Model\Population;
use Rtb\Population\Domain\Model\PopulationCollection;
use Rtb\Population\Domain\ValueObject\Country;
use Rtb\Population\Domain\ValueObject\Number;

final class UserCollectionFactoryTest extends TestCase
{
    public function testWhenInternetUserCollectionContainsNonExistentCountryInPopulationCollection(): void
    {
        $population1 = new Population(new Country('China'), new DateTime(), new Number(123456789));
        $population2 = new Population(new Country('Poland'), new DateTime(), new Number(11111111));
        $population3 = new Population(new Country('Russia'), new DateTime(), new Number(2222222));

        $internetUser1 = new InternetUser(new Country('china'), new Number(99999999), new Number(6666666));
        $internetUser2 = new InternetUser(new Country('some'), new Number(333333), new Number(444444));

        $internetUserCollection = new InternetUserCollection($internetUser1, $internetUser2);
        $populationCollection = new PopulationCollection($population1, $population2, $population3);

        $userCollection = UserCollectionFactory::create($populationCollection, $internetUserCollection);
        $elements = $userCollection->collection();

        $this->assertCount(4, $userCollection);
        $this->assertEquals('China', $elements[0]->country());
        $this->assertEquals(99999999, $elements[0]->internetUsers());
        $this->assertEquals(123456789, $elements[0]->population());

        $this->assertEquals(11111111, $elements[1]->population());
        $this->assertEquals(2222222, $elements[2]->population());
        $this->assertNull($elements[1]->internetUsers());
        $this->assertNull($elements[2]->internetUsers());
        $this->assertNull($elements[3]->date());
    }
}
