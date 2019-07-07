<?php

declare(strict_types=1);


namespace Rtb\Population\Domain\Model;

use PHPUnit\Framework\TestCase;

final class PopulationTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            ' polAND',
            '123,456',
            'July 6, 2019',
        ];

        $population = Population::fromArray($data);

        $this->assertEquals('poland', $population->country());
        $this->assertEquals('123456', $population->population());
        $this->assertEquals('July 6, 2019', $population->date()->format('F j, Y'));
    }
}
