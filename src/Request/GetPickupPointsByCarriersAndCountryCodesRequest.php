<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Request;

use Answear\MwlBundle\Request\Struct\CarrierAndCountryCode;

readonly class GetPickupPointsByCarriersAndCountryCodesRequest extends Request
{
    private const ENDPOINT = '/points/getPickupPointsByCarriersAndCountryCodes';
    private const HTTP_METHOD = 'POST';

    /**
     * @param CarrierAndCountryCode[] $data
     */
    public function __construct(public array $data)
    {
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }

    public function getMethod(): string
    {
        return self::HTTP_METHOD;
    }

    public function getBody(): array
    {
        $params = [];

        foreach ($this->data as $carrierAndCountryCode) {
            $params[] = [
                'carrier' => $carrierAndCountryCode->carrier->value,
                'country' => $carrierAndCountryCode->countryCode->value,
            ];
        }

        return $params;
    }
}
