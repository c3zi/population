<?php

require 'vendor/autoload.php';

use Rtb\Population\Application\Service\TableGenerator;
use Rtb\Population\Infrastructure\Service\DomCrawlerInternetUserProvider;
use Rtb\Population\Infrastructure\Service\DomCrawlerPopulationProvider;
use Rtb\Population\Infrastructure\Service\CsvTableRenderer;

$populationProvider = new DomCrawlerPopulationProvider();
$internetUserProvider = new DomCrawlerInternetUserProvider();
$tableRenderer = new CsvTableRenderer('./data/');

$tableGenerator = new TableGenerator($internetUserProvider, $populationProvider, $tableRenderer);
$tableGenerator->generate();
