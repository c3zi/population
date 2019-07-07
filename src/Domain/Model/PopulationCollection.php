<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

final class PopulationCollection implements IteratorAggregate
{
    private $elements;

    public function __construct(Population ...$populations)
    {
        /** @var Population $population */
        foreach ($populations as $population) {
            $this->elements[$population->country()] = $population;
        }
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}
