<?php

declare(strict_types=1);


namespace Rtb\Population\Domain\Model;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

final class UserCollection implements IteratorAggregate
{
    private $elements;

    public function __construct(?array $elements = [])
    {
        $this->elements = $elements;
    }

    public function add(User $user): void
    {
        $this->elements[] = $user;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }

    public function collection(): array
    {
        return $this->elements;
    }
}
