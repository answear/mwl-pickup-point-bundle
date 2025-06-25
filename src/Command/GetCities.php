<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\Request\GetCitiesRequest;
use Answear\MwlBundle\Response\GetCitiesResponse;

readonly class GetCities extends AbstractCommand
{
    public function __construct(private Client $client)
    {
    }

    public function getCities(GetCitiesRequest $request): GetCitiesResponse
    {
        $response = $this->client->request($request);

        return GetCitiesResponse::fromArray(
            $this->getBody($response),
        );
    }
}
