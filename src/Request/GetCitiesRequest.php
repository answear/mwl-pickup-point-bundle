<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Request;

readonly class GetCitiesRequest extends Request
{
    private const ENDPOINT = '/cities';
    private const HTTP_METHOD = 'GET';
    private const DEFAULT_COUNTRY = 'UA';

    public function __construct(
        public ?string $country = self::DEFAULT_COUNTRY,
    ) {
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }

    public function getMethod(): string
    {
        return self::HTTP_METHOD;
    }

    public function getQueryParams(): array
    {
        return ['country' => $this->country];
    }
}
