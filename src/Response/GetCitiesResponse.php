<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response;

use Answear\MwlBundle\Response\Struct\CitiesCollection;
use Answear\MwlBundle\Response\Struct\City;

class GetCitiesResponse
{
    public function __construct(
        public CitiesCollection $cities,
    ) {
    }

    public function getCities(): CitiesCollection
    {
        return $this->cities;
    }

    public static function fromArray(array $arrayResponse): self
    {
        return new self(
            new CitiesCollection(
                array_map(
                    static fn($cityData) => City::fromArray($cityData),
                    $arrayResponse,
                )
            )
        );
    }
}
