<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

final class InternetUserCollection implements Countable, IteratorAggregate
{
    private $elements = [];

    public function __construct(InternetUser ...$internetUsers)
    {
        /** @var InternetUser $internetUser */
        foreach ($internetUsers as $internetUser) {
            $this->elements[$internetUser->country()] = $internetUser;
        }
    }

    public function remove(string $key): void
    {
        unset($this->elements[$key]);
    }

    public function search(string $key): ?InternetUser
    {
        return $this->elements[$key] ?? null;
    }

    public function total(): int
    {
        $sum = 0;
        /** @var InternetUser $element */
        foreach ($this->elements as $element) {
            $sum += $element->users();
        }

        return $sum;
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}
