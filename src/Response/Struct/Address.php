<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class Address
{
    public function __construct(
        public string $countryCode,
        public string $city,
        public string $cityIDRef,
        public string $street,
        public string $buildingNumber,
        public ?string $district,
        public ?string $region,
        public string $zipCode,
        public string $locationDescription,
    ) {
    }

    public static function fromArray(array $pointData): self
    {
        Assert::stringNotEmpty($pointData['countryCode']);
        Assert::stringNotEmpty($pointData['city']);
        Assert::stringNotEmpty($pointData['cityIDRef']);
        Assert::stringNotEmpty($pointData['street']);
        Assert::string($pointData['buildingNumber']);
        Assert::nullOrStringNotEmpty($pointData['district']);
        Assert::nullOrStringNotEmpty($pointData['region']);
        Assert::string($pointData['zipCode']);
        Assert::string($pointData['locationDescription']);

        return new self(
            $pointData['countryCode'],
            $pointData['city'],
            $pointData['cityIDRef'],
            $pointData['street'],
            $pointData['buildingNumber'],
            $pointData['district'],
            $pointData['region'],
            $pointData['zipCode'],
            $pointData['locationDescription'],
        );
    }
}
