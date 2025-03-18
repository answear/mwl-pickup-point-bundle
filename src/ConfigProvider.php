<?php

declare(strict_types=1);

namespace Answear\MwlBundle;

readonly class ConfigProvider
{
    public const URL = 'https://mwl.meest.com';
    public const SERVICE_URI = '/mwl';

    public function __construct(
        private string $partnerKey,
        private string $secretKey,
    ) {
    }

    public function getRequestHeaders(): array
    {
        return [
            'base_uri' => self::URL,
            'headers' => [
                'Authorization' => hash('sha256', $this->partnerKey . $this->secretKey),
            ],
        ];
    }
}
