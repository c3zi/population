<?php

declare(strict_types=1);

namespace Rtb\Population\Infrastructure\Service;

use Rtb\Population\Domain\Exception\DomainException;
use Rtb\Population\Domain\Model\InternetUser;
use Rtb\Population\Domain\Model\InternetUserCollection;
use Rtb\Population\Domain\Service\InternetUserProvider;
use Symfony\Component\DomCrawler\Crawler;
use function sprintf;
use function file_get_contents;

class DomCrawlerInternetUserProvider implements InternetUserProvider
{
    private const URL = 'https://en.wikipedia.org/wiki/List_of_countries_by_number_of_Internet_users';

    public function provide(): InternetUserCollection
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
                        return $td->text();
                    });

                if (!empty($data)) {
                    return InternetUser::fromArray($data);
                }
            });

        if (empty($data[0])) {
            unset($data[0]);
        }

        return new InternetUserCollection(...$data);
    }
}
