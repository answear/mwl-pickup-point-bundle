<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Answear\MwlBundle\Request\GetCitiesRequest;
use Answear\MwlBundle\Response\GetCitiesResponse;

readonly class GetCities extends AbstractCommand
{
    public function getCities(GetCitiesRequest $request): GetCitiesResponse
    {
        $response = $this->getResponse($request);

        return GetCitiesResponse::fromArray(
            $this->getBody($response),
        );
    }
}
