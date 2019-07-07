<?php

declare(strict_types=1);

namespace Rtb\Population\Domain\Model;

use PHPUnit\Framework\TestCase;

final class InternetUserTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            '  china',
            '123,222,333',
            '123,789,654'
        ];

        $internetUser = InternetUser::fromArray($data);

        $this->assertEquals(123789654.0, $internetUser->population());
        $this->assertEquals(123222333.0, $internetUser->users());
        $this->assertEquals('china', $internetUser->country());
    }
}
