<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Request;

class GetPickupPointsRequest extends Request
{
    private const ENDPOINT = '/points/getPickupPoints';
    private const HTTP_METHOD = 'GET';

    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }

    public function getMethod(): string
    {
        return self::HTTP_METHOD;
    }
}
