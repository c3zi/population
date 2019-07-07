<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\ValueObject;

use function preg_replace;
use function ucfirst;

final class Country
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = mb_strtolower($this->removeUnsupportedCharacters($name));
    }

    private function removeUnsupportedCharacters(string $name): string
    {
        return trim(preg_replace( '/[^[:print:]]/', '', $name));
    }

    public function name(): string
    {
        return $this->name;
    }

    public function toString(): string
    {
        return ucfirst($this->name);
    }
}
