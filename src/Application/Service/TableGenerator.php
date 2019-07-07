<?php

declare(strict_types=1);

namespace Rtb\Population\Application\Service;

use Rtb\Population\Domain\Factory\UserCollectionFactory;
use Rtb\Population\Domain\Service\InternetUserProvider;
use Rtb\Population\Domain\Service\PopulationProvider;
use Rtb\Population\Domain\Service\TableRenderer;

class TableGenerator
{
    /** @var InternetUserProvider */
    private $internetUserProvider;
    /** @var PopulationProvider */
    private $populationProvider;
    /** @var TableRenderer */
    private $tableRenderer;

    public function __construct(
        InternetUserProvider $internetUserProvider,
        PopulationProvider $populationProvider,
        TableRenderer $tableRenderer
    ) {
        $this->internetUserProvider = $internetUserProvider;
        $this->populationProvider = $populationProvider;
        $this->tableRenderer = $tableRenderer;
    }

    public function generate(): void
    {
        $internetUserCollection = $this->internetUserProvider->provide();
        $populationCollection = $this->populationProvider->provide();

        $userCollection = UserCollectionFactory::create(
            $populationCollection,
            $internetUserCollection
        );

        $this->tableRenderer->render($userCollection);
    }
}
