<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Tests\Integration\Command;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\Client\RequestTransformer;
use Answear\MwlBundle\Client\Serializer;
use Answear\MwlBundle\Command\GetCities;
use Answear\MwlBundle\ConfigProvider;
use Answear\MwlBundle\Request\GetCitiesRequest;
use Answear\MwlBundle\Response\GetCitiesResponse;
use Answear\MwlBundle\Response\Struct\City;
use Answear\MwlBundle\Tests\MockGuzzleTrait;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class GetCitiesTest extends TestCase
{
    use MockGuzzleTrait;

    private Client $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client(new ConfigProvider('test', 'Qwerty123!'), $this->setupGuzzleClient());
    }

    #[Test]
    public function successfulGetCities(): void
    {
        $command = $this->getCommand();
        $this->mockGuzzleResponse(new Response(200, [], $this->getSuccessfulBody()));

        $response = $command->getCities(new GetCitiesRequest());

        $this->assertCount(25, $response->getCities());
        $this->assertCity($response);
    }

    private function assertCity(GetCitiesResponse $response): void
    {
        /** @var City $city */
        $city = $response->getCities()->getIterator()->current();

        $this->assertSame(
            [
                'КІРОВОГРАДСЬКА',
                'КИРОВОГРАДСКАЯ',
                'KIROVOGRADS`KA',
                'Кропивницький (Кіровоград)',
                'Кропивницький',
                'Kropyvnytskyi (Kirovograd)',
                'Новогомельське',
                'Новогомельское',
                'Novogomelske',
                '6ed81960-749b-11df-b112-00215aee3ebe',
                [
                    '27215',
                ],
            ],
            [
                $city->regionUa,
                $city->regionRu,
                $city->regionEn,
                $city->districtUa,
                $city->districtRu,
                $city->districtEn,
                $city->cityUa,
                $city->cityRu,
                $city->cityEn,
                $city->cityId,
                $city->postCodes,
            ]
        );
    }

    private function getCommand(): GetCities
    {
        $transformer = new RequestTransformer(new Serializer());

        return new GetCities($this->client, $transformer);
    }

    private function getSuccessfulBody(): string
    {
        return file_get_contents(__DIR__ . '/data/example.getCitiesResponse.json');
    }
}
