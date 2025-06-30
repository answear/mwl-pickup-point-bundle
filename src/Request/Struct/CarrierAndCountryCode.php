<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Request\Struct;

use Answear\MwlBundle\Enum\CarrierEnum;
use Answear\MwlBundle\Enum\CountryCodeEnum;

readonly class CarrierAndCountryCode
{
    public function __construct(
        public CarrierEnum $carrier,
        public CountryCodeEnum $countryCode,
    ) {
    }
}
