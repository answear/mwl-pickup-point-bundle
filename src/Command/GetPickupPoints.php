<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\Client\RequestTransformer;
use Answear\MwlBundle\Request\GetPickupPointsRequest;
use Answear\MwlBundle\Response\GetPickupPointsResponse;

readonly class GetPickupPoints extends AbstractCommand
{
    public function __construct(
        private Client $client,
        private RequestTransformer $transformer,
    ) {
    }

    public function getPickupPoints(GetPickupPointsRequest $request): GetPickupPointsResponse
    {
        $httpRequest = $this->transformer->transform($request);
        $response = $this->client->request($httpRequest);

        return GetPickupPointsResponse::fromArray(
            $this->getBody($response),
        );
    }
}
