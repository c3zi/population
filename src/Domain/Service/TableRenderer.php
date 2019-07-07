<?php

declare(strict_types=1);


namespace Rtb\Population\Domain\Service;

use Rtb\Population\Domain\Model\UserCollection;

interface TableRenderer
{
    public function render(UserCollection $collection): void;
}
