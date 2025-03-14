<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Enum;

enum DivisionTypeEnum: string
{
    case LargeWarehouse = '1';
    case StoreOrSmallWarehouse = '2';
    case PostalLocker = '3';
}
