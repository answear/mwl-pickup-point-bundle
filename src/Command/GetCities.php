<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\Client\RequestTransformer;
use Answear\MwlBundle\Request\GetCitiesRequest;
use Answear\MwlBundle\Response\GetCitiesResponse;

readonly class GetCities extends AbstractCommand
{
    public function __construct(
        private Client $client,
        private RequestTransformer $transformer,
    ) {
    }

    public function getCities(GetCitiesRequest $request): GetCitiesResponse
    {
        $httpRequest = $this->transformer->transform($request);
        $response = $this->client->request($httpRequest);

        return GetCitiesResponse::fromArray(
            $this->getBody($response),
        );
    }
}
