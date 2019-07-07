<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use DateTime;
use Rtb\Population\Domain\ValueObject\Country;

final class User
{
    /** @var Country */
    private $country;
    /** @var int|null */
    private $population;
    /** @var DateTime|null */
    private $dateTime;
    /** @var int|null */
    private $internetUsers;
    /** @var float|null */
    private $percentageInternetUserToPopulation;
    /** @var float|null */
    private $percentageInternetUserToWorldWideUsers;

    public function __construct(
        Country $country,
        ?int $population = null,
        ?DateTime $dateTime = null,
        ?int $internetUsers = null,
        ?int $total = null
    ) {
        if ($country->name() === 'saint helena') {
            $a = 1;

        }
        $this->country = $country;
        $this->population = $population;
        $this->dateTime = $dateTime;
        $this->internetUsers = $internetUsers;
        $this->percentageInternetUserToPopulation = ($internetUsers && $population)
            ? (float)number_format(($internetUsers / $population) * 100)
            : null;

        $this->percentageInternetUserToWorldWideUsers = ($internetUsers && $total)
            ? (float)number_format(($internetUsers / $total) * 100, 5)
            : null;
    }

    public function country(): string
    {
        return $this->country->toString();
    }

    public function population(): ?int
    {
        return $this->population;
    }

    public function date(): ?DateTime
    {
        return $this->dateTime;
    }

    public function internetUserCountryToPopulationCountry(): ?float
    {
        return $this->percentageInternetUserToPopulation;
    }

    public function internetUserCountryToWorldWide(): ?float
    {
        return $this->percentageInternetUserToWorldWideUsers;
    }

    public function internetUsers(): ?int
    {
        return $this->internetUsers;
    }

    public function formattedPopulation(): string
    {
        return $this->formatNumber($this->population);
    }

    public function formattedInternetUsers(): string
    {
        return $this->formatNumber($this->internetUsers);
    }

    private function formatNumber(int $number): string
    {
        return number_format($number, 0, ' ', ' ');
    }
}
