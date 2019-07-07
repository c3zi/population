<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use DateTime;
use Rtb\Population\Domain\ValueObject\Country;
use Rtb\Population\Domain\ValueObject\Number;

final class Population
{
    /** @var Country */
    private $country;
    /** @var DateTime */
    private $dateTime;
    /** @var Number */
    private $population;

    public function __construct(
        Country $country,
        DateTime $dateTime,
        Number $population
    )
    {
        $this->country = $country;
        $this->dateTime = $dateTime;
        $this->population = $population;
    }

    public function country(): string
    {
        return $this->country->name();
    }

    public function population(): int
    {
        return $this->population->value();
    }

    public function date(): DateTime
    {
        return $this->dateTime;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new Country($data[0]),
            DateTime::createFromFormat('F j, Y', $data[2]),
            Number::fromString($data[1])
        );
    }
}
