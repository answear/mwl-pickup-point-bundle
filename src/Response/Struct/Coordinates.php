<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class Coordinates
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {
    }

    public static function fromArray(array $pointData): self
    {
        Assert::float($pointData['latitude']);
        Assert::float($pointData['longitude']);
        Assert::range($pointData['latitude'], -90, 90);
        Assert::range($pointData['longitude'], -180, 180);

        return new self(
            $pointData['latitude'],
            $pointData['longitude'],
        );
    }
}
