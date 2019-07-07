<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Factory;

use Rtb\Population\Domain\Model\InternetUser;
use Rtb\Population\Domain\Model\InternetUserCollection;
use Rtb\Population\Domain\Model\User;
use Rtb\Population\Domain\Model\Population;
use Rtb\Population\Domain\Model\PopulationCollection;
use Rtb\Population\Domain\Model\UserCollection;
use Rtb\Population\Domain\ValueObject\Country;

final class UserCollectionFactory
{
    public static function create(
        PopulationCollection $populationCollection,
        InternetUserCollection $internetUserCollection
    ): UserCollection {
        $total = $internetUserCollection->total();
        $userCollection = new UserCollection();

        /** @var Population $population */
        foreach ($populationCollection as $population) {
            $country = $population->country();
            $internetUser = $internetUserCollection->search($country);

            $internetUserNumbers = $internetUser ? $internetUser->users() : null;
            $internetUserCollection->remove($country);

            $userCollection->add(new User(
                new Country($country),
                $population->population(),
                $population->date(),
                $internetUserNumbers,
                $total
            ));
        }

        if ($internetUserCollection->count() > 0) {
            /** @var InternetUser $internetUser */
            foreach ($internetUserCollection as $internetUser) {
                $country = $internetUser->country();

                $userCollection->add(new User(
                    new Country($country),
                    $internetUser->population(),
                    null,
                    $internetUser->users(),
                    $total
                ));
            }
        }

        return $userCollection;
    }
}
