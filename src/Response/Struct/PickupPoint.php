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
        public ?string $openHours,
        public Address $address,
        public Coordinates $coordinates,
        public bool $cod,
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
        Assert::nullOrString($pointData['openHours']);
        Assert::boolean($pointData['cod']);
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
            $pointData['openHours'],
            Address::fromArray($pointData),
            Coordinates::fromArray($pointData),
            $pointData['cod'],
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
