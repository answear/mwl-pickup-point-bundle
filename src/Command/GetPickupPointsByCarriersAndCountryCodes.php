<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\Request\GetPickupPointsByCarriersAndCountryCodesRequest;
use Answear\MwlBundle\Response\GetPickupPointsResponse;

readonly class GetPickupPointsByCarriersAndCountryCodes extends AbstractCommand
{
    public function __construct(private Client $client)
    {
    }

    public function getPickupPointsByCarriersAndCountryCodesRequest(GetPickupPointsByCarriersAndCountryCodesRequest $request): GetPickupPointsResponse
    {
        $response = $this->client->request($request);

        return GetPickupPointsResponse::fromArray(
            $this->getBody($response),
        );
    }
}
