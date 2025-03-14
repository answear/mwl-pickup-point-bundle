<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Tests\Unit;

use Answear\MwlBundle\ConfigProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    #[Test]
    public function gettersAreValid(): void
    {
        $configuration = new ConfigProvider('test', 'Qwerty123!');

        $this->assertSame('https://mwl.meest.com', ConfigProvider::URL);
        $this->assertSame('/mwl', ConfigProvider::SERVICE_URI);
        $this->assertSame(
            [
                'base_uri' => 'https://mwl.meest.com',
                'headers' => [
                    'Authorization' => 'b08ae6abecee890d81f7176c45bad6356ab1c28597f460af1d4ddac8448d2664',
                ],
            ],
            $configuration->getRequestHeaders(),
        );
    }
}
