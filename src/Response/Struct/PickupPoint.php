<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response\Struct;

use Answear\MwlBundle\Enum\DivisionTypeEnum;
use Answear\MwlBundle\Enum\TagTypeEnum;
use Webmozart\Assert\Assert;

readonly class PickupPoint
{
    public function __construct(
        public int $id,
        public string $originId,
        public ?string $pointCode,
        public string $pointType,
        public ?string $pointName,
        public string $countryCode,
        public string $city,
        public string $cityIDRef,
        public string $street,
        public string $buildingNumber,
        public ?string $district,
        public ?string $region,
        public ?string $openHours,
        public float $latitude,
        public float $longitude,
        public bool $cod,
        public string $zipCode,
        public string $locationDescription,
        public ?DivisionTypeEnum $divisionType,
        public string $divisionCode,
        public bool $cashPayType,
        public bool $cardPayType,
        public float $maxWeight,
        public ?string $name,
        public ?TagTypeEnum $tag,
    ) {
    }

    public static function fromArray(array $pointData): self
    {
        Assert::integer($pointData['id']);
        Assert::stringNotEmpty($pointData['originId']);
        Assert::nullOrStringNotEmpty($pointData['pointCode']);
        Assert::string($pointData['pointType']);
        Assert::nullOrStringNotEmpty($pointData['pointName']);
        Assert::stringNotEmpty($pointData['countryCode']);
        Assert::stringNotEmpty($pointData['city']);
        Assert::stringNotEmpty($pointData['cityIDRef']);
        Assert::stringNotEmpty($pointData['street']);
        Assert::string($pointData['buildingNumber']);
        Assert::nullOrStringNotEmpty($pointData['district']);
        Assert::nullOrStringNotEmpty($pointData['region']);
        Assert::nullOrString($pointData['openHours']);
        Assert::float($pointData['latitude']);
        Assert::float($pointData['longitude']);
        Assert::range($pointData['latitude'], -90, 90);
        Assert::range($pointData['longitude'], -180, 180);
        Assert::boolean($pointData['cod']);
        Assert::string($pointData['zipCode']);
        Assert::string($pointData['locationDescription']);
        Assert::string($pointData['divisionType']);
        Assert::string($pointData['divisionCode']);
        Assert::boolean($pointData['cashPayType']);
        Assert::boolean($pointData['cardPayType']);
        Assert::float($pointData['maxWeight']);
        Assert::nullOrString($pointData['name']);
        Assert::string($pointData['tag']);

        return new self(
            $pointData['id'],
            $pointData['originId'],
            $pointData['pointCode'],
            $pointData['pointType'],
            $pointData['pointName'],
            $pointData['countryCode'],
            $pointData['city'],
            $pointData['cityIDRef'],
            $pointData['street'],
            $pointData['buildingNumber'],
            $pointData['district'],
            $pointData['region'],
            $pointData['openHours'],
            $pointData['latitude'],
            $pointData['longitude'],
            $pointData['cod'],
            $pointData['zipCode'],
            $pointData['locationDescription'],
            DivisionTypeEnum::tryFrom($pointData['divisionType']),
            $pointData['divisionCode'],
            $pointData['cashPayType'],
            $pointData['cardPayType'],
            $pointData['maxWeight'],
            $pointData['name'],
            TagTypeEnum::tryFrom($pointData['tag']),
        );
    }
}
