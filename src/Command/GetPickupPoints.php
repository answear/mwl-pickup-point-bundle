<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Answear\MwlBundle\Request\GetPickupPointsRequest;
use Answear\MwlBundle\Response\GetPickupPointsResponse;

readonly class GetPickupPoints extends AbstractCommand
{
    public function getPickupPoints(GetPickupPointsRequest $request): GetPickupPointsResponse
    {
        $response = $this->client->request($request);

        return GetPickupPointsResponse::fromArray(
            $this->getBody($response),
        );
    }
}
