<?php

declare(strict_types=1);


namespace Rtb\Population\Infrastructure\Service;

use DateTime;
use function fputcsv;
use Rtb\Population\Domain\Model\User;
use Rtb\Population\Domain\Model\UserCollection;
use Rtb\Population\Domain\Service\TableRenderer;

class CsvTableRenderer implements TableRenderer
{
    /** @var string */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function render(UserCollection $collection): void
    {
        $headers = [
            'Country (or dependent territory)',
            'Population',
            'Date',
            'Internet users',
            'Percentage: internet users in a country / population in a country',
            'Percentage: internet users in a country / internet users worldwide',
        ];

        $file = sprintf('%s/file_%s.csv', $this->path, (new DateTime())->format('Y-m-d'));
        $fp = fopen($file, 'w');

        fputcsv($fp, $headers);

        /** @var User $user */
        foreach ($collection as $user) {

            $internetToPopulation = $user->internetUserCountryToPopulationCountry();
            $internetToWorldwideInternet = $user->internetUserCountryToWorldWide();

            $fields = [
                $user->country(),
                $user->population() ? $user->formattedPopulation() : '--',
                $user->date() ? $user->date()->format('F j, Y') : '--',
                $user->internetUsers() ? $user->formattedInternetUsers() : '--',
                $internetToPopulation ? $internetToPopulation . '%' : '--',
                $internetToWorldwideInternet ? $internetToWorldwideInternet . '%' : '--',
            ];

            fputcsv($fp, $fields);
        }

        fclose($fp);
    }
}
