<?php

declare(strict_types=1);


namespace Rtb\Population\Domain\ValueObject;

use function str_replace;

final class Number
{
    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        $val = (int)str_replace(',', '', $value);

        return new self($val);
    }

    public function value(): int
    {
        return $this->value;
    }
}
