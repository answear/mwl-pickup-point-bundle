<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class PickupPointCollection implements \Countable, \IteratorAggregate
{
    /**
     * @param PickupPoint[] $pickupPoints
     */
    public function __construct(
        private array $pickupPoints,
    ) {
        Assert::allIsInstanceOf($pickupPoints, PickupPoint::class);
    }

    /**
     * @return \ArrayIterator<PickupPoint>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->pickupPoints);
    }

    public function count(): int
    {
        return \count($this->pickupPoints);
    }
}
