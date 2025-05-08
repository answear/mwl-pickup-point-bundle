<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class City
{
    /** @param array<string>|null $postCodes */
    public function __construct(
        public ?string $regionUa,
        public ?string $regionRu,
        public ?string $regionEn,
        public ?string $districtUa,
        public ?string $districtRu,
        public ?string $districtEn,
        public ?string $cityUa,
        public ?string $cityRu,
        public ?string $cityEn,
        public ?string $cityId,
        public ?array $postCodes,
    ) {
    }

    public static function fromArray(array $pointData): self
    {
        Assert::nullOrString($pointData['regionUA']);
        Assert::nullOrString($pointData['regionRU']);
        Assert::nullOrString($pointData['regionEN']);
        Assert::nullOrString($pointData['districtUA']);
        Assert::nullOrString($pointData['districtRU']);
        Assert::nullOrString($pointData['districtEN']);
        Assert::nullOrString($pointData['cityUA']);
        Assert::nullOrString($pointData['cityRU']);
        Assert::nullOrString($pointData['cityEN']);
        Assert::nullOrString($pointData['cityID']);
        Assert::nullOrIsArray($pointData['postCodes']);

        return new self(
            $pointData['regionUA'],
            $pointData['regionRU'],
            $pointData['regionEN'],
            $pointData['districtUA'],
            $pointData['districtRU'],
            $pointData['districtEN'],
            $pointData['cityUA'],
            $pointData['cityRU'],
            $pointData['cityEN'],
            $pointData['cityID'],
            $pointData['postCodes'],
        );
    }
}
