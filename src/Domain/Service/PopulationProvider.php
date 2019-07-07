<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Service;

use Rtb\Population\Domain\Exception\DomainException;
use Rtb\Population\Domain\Model\PopulationCollection;

interface PopulationProvider
{
    /**
     * @return PopulationCollection
     * @throws DomainException
     */
    public function provide(): PopulationCollection;
}
