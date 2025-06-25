<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Tests\Integration\Command;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\Command\GetPickupPointsByCarriersAndCountryCodes;
use Answear\MwlBundle\ConfigProvider;
use Answear\MwlBundle\Enum\CarrierEnum;
use Answear\MwlBundle\Enum\CountryCodeEnum;
use Answear\MwlBundle\Enum\DivisionTypeEnum;
use Answear\MwlBundle\Enum\TagTypeEnum;
use Answear\MwlBundle\Request\GetPickupPointsByCarriersAndCountryCodesRequest;
use Answear\MwlBundle\Request\Struct\CarrierAndCountryCode;
use Answear\MwlBundle\Response\GetPickupPointsResponse;
use Answear\MwlBundle\Response\Struct\PickupPoint;
use Answear\MwlBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GetPickupPointsByCarriersAndCountryCodesTest extends TestCase
{
    use MockGuzzleTrait;

    private Client $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client(new ConfigProvider('test', 'Qwerty123!'), $this->setupGuzzleClient());
    }

    #[Test]
    public function successfulGetPickupPointsByCarriersAndCountryCodes(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->getPickupPointsByCarriersAndCountryCodesRequest(
            new GetPickupPointsByCarriersAndCountryCodesRequest(
                [
                    new CarrierAndCountryCode(
                        CarrierEnum::Meest,
                        CountryCodeEnum::Ukraine
                    )
                ]
            )
        );

        $this->assertCount(10, $response->getPickupPoints());
        $this->assertPickupPoint($response);
    }

    private function assertPickupPoint(GetPickupPointsResponse $response): void
    {
        /** @var PickupPoint $point */
        $point = $response->getPickupPoints()->getIterator()->current();

        $this->assertSame($point->id, 23845950);
        $this->assertSame($point->originId, '0x80c8000c2961d09111effdb578bba2a0');
        $this->assertSame($point->pointCode, null);
        $this->assertSame($point->pointType, 'MEEST');
        $this->assertSame($point->pointName, null);
        $this->assertSame($point->address->countryCode, 'UA');
        $this->assertSame($point->address->city, 'Біла Церква');
        $this->assertSame($point->address->cityIDRef, '0xb11200215aee3ebe11df749b44ac8365');
        $this->assertSame($point->address->street, 'Михайла Сидорянського (Піщаний 1-й)');
        $this->assertSame($point->address->buildingNumber, '7Б');
        $this->assertSame($point->address->district, 'Білоцерківський');
        $this->assertSame($point->address->region, 'КИЇВСЬКА');
        $this->assertSame($point->address->zipCode, '09100');
        $this->assertSame($point->address->locationDescription, 'Відділення №82, м. Біла Церква, пров. Михайла Сидорянського (Піщаний 1-й), 7Б (Rozetka,на касі)');
        $this->assertSame($point->openHours, 'Пн 09:00 - 20:00; Вт 09:00 - 20:00; Ср 09:00 - 20:00; Чт 09:00 - 20:00; Пт 09:00 - 20:00; Сб 09:00 - 20:00; Нд 10:00 - 19:00');
        $this->assertSame($point->coordinates->latitude, 49.7885);
        $this->assertSame($point->coordinates->longitude, 30.0908);
        $this->assertSame($point->cod, true);
        $this->assertSame($point->divisionType, DivisionTypeEnum::StoreOrSmallWarehouse);
        $this->assertSame($point->divisionCode, '21481');
        $this->assertSame($point->cashPayType, false);
        $this->assertSame($point->cardPayType, true);
        $this->assertSame($point->maxWeight, 30.0);
        $this->assertSame($point->name, null);
        $this->assertSame($point->tag, TagTypeEnum::MeestPartner);
    }

    private function getCommand(): GetPickupPointsByCarriersAndCountryCodes
    {
        return new GetPickupPointsByCarriersAndCountryCodes($this->client);
    }

    private function getSuccessfulBody(): string
    {
        return file_get_contents(__DIR__ . '/data/example.getPickupPointsResponse.json');
    }
}
