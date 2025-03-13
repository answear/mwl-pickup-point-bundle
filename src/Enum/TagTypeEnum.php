<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Enum;

enum TagTypeEnum: string
{
    case MeestOwn = 'MEEST_OWN';
    case MeestPartner = 'MEEST_PARTNER';
}
