<?php

declare(strict_types=1);

namespace Rtb\Population\Infrastructure\Service;

use Rtb\Population\Domain\Exception\DomainException;
use Rtb\Population\Domain\Model\Population;
use Rtb\Population\Domain\Model\PopulationCollection;
use Rtb\Population\Domain\Service\PopulationProvider;
use Symfony\Component\DomCrawler\Crawler;
use function file_get_contents;
use function preg_replace;

class DomCrawlerPopulationProvider implements PopulationProvider
{
    private const URL = 'https://en.wikipedia.org/wiki/List_of_countries_and_dependencies_by_population';

    public function provide(): PopulationCollection
    {
        $page = @file_get_contents(self::URL);

        if ($page === false) {
            throw new DomainException(sprintf('Could not fetched data from given url (%s).', self::URL));
        }

        $crawler = new Crawler($page);
        $data = $crawler
            ->filter('.wikitable')
            ->filter('tr')
            ->each(static function ($tr) {
                $data =  $tr
                    ->filter('td')
                    ->each(static function ($td) {
                        return preg_replace('#(\[.*\])#', '', trim($td->text()));
                    });

                if (!empty($data)) {
                    return Population::fromArray([$data[1], $data[2], $data[3]]);
                }
        });

        if (empty($data[0])) {
            unset($data[0]);
        }

        return new PopulationCollection(...$data);
    }
}
