<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response;

use Answear\MwlBundle\Response\Struct\PickupPoint;
use Answear\MwlBundle\Response\Struct\PickupPointCollection;

class GetPickupPointsResponse
{
    public function __construct(
        public PickupPointCollection $pickupPoints,
    ) {
    }

    public function getPickupPoints(): PickupPointCollection
    {
        return $this->pickupPoints;
    }

    public static function fromArray(array $arrayResponse): self
    {
        return new self(
            new PickupPointCollection(
                array_map(
                    static fn($pickupPointData) => PickupPoint::fromArray($pickupPointData),
                    $arrayResponse,
                )
            )
        );
    }
}
