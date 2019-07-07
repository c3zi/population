<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use Rtb\Population\Domain\ValueObject\Country;
use Rtb\Population\Domain\ValueObject\Number;

final class InternetUser
{
    /** @var Country */
    private $country;
    /** @var Number */
    private $internetUsers;
    /** @var Number */
    private $population;

    public function __construct(
        Country $country,
        Number $internetUsers,
        Number $population
    ) {
        $this->country = $country;
        $this->internetUsers = $internetUsers;
        $this->population = $population;
    }

    public function country(): string
    {
        return $this->country->name();
    }

    public function users(): int
    {
        return $this->internetUsers->value();
    }

    public function population(): int
    {
        return $this->population->value();
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new Country($data[0]),
            Number::fromString($data[1]),
            Number::fromString($data[2])
        );
    }
}
