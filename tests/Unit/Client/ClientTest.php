<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Tests\Unit\Client;

use Answear\MwlBundle\Client\Client;
use Answear\MwlBundle\ConfigProvider;
use Answear\MwlBundle\Request\Request;
use Answear\MwlBundle\Request\Transformer\RequestTransformer;
use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ClientTest extends TestCase
{
    private ResponseInterface $response;

    public function setUp(): void
    {
        parent::setUp();

        $this->response = $this->createMock(ResponseInterface::class);
        $this->response->method('getBody')->willReturn($this->createMock(StreamInterface::class));
    }

    #[Test]
    public function simpleGetRequest(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getEndpoint')->willReturn('/mwl/cities');

        $psrRequest = RequestTransformer::transform($request);

        $clientInterface = $this->createMock(ClientInterface::class);
        $clientInterface
            ->expects($this->once())
            ->method('send')
            ->with($psrRequest, [])
            ->willReturn($this->response);


        $client = new Client(
            $this->createMock(ConfigProvider::class),
            $clientInterface
        );

        $client->request($request);
    }

    #[Test]
    public function getRequestWithQueryParams(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getMethod')->willReturn('GET');
        $request->method('getEndpoint')->willReturn('/mwl/cities');
        $request->method('getQueryParams')->willReturn(['countryCode' => 'UA']);

        $psrRequest = RequestTransformer::transform($request);

        $clientInterface = $this->createMock(ClientInterface::class);
        $clientInterface
            ->expects($this->once())
            ->method('send')
            ->with(
                $psrRequest,
                [
                    'query' => [
                        'countryCode' => 'UA'
                    ]
                ]
            )
            ->willReturn($this->response);

        $client = new Client(
            $this->createMock(ConfigProvider::class),
            $clientInterface
        );

        $client->request($request);
    }

    #[Test]
    public function postRequestWithBody(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getMethod')->willReturn('POST');
        $request->method('getEndpoint')->willReturn('/mwl/cities');
        $request->method('getBody')->willReturn(['countryCode' => 'UA']);

        $psrRequest = RequestTransformer::transform($request);

        $clientInterface = $this->createMock(ClientInterface::class);
        $clientInterface
            ->expects($this->once())
            ->method('send')
            ->with(
                $psrRequest,
                [
                    'json' => [
                        'countryCode' => 'UA'
                    ]
                ]
            )
            ->willReturn($this->response);

        $client = new Client(
            $this->createMock(ConfigProvider::class),
            $clientInterface
        );

        $client->request($request);
    }

    #[Test]
    public function postRequestWithBodyAndQueryParams(): void
    {
        $request = $this->createMock(Request::class);
        $request->method('getMethod')->willReturn('POST');
        $request->method('getEndpoint')->willReturn('/mwl/cities');
        $request->method('getQueryParams')->willReturn(['countryCode' => 'UA']);
        $request->method('getBody')->willReturn(['countryCode' => 'UA']);

        $psrRequest = RequestTransformer::transform($request);

        $clientInterface = $this->createMock(ClientInterface::class);
        $clientInterface
            ->expects($this->once())
            ->method('send')
            ->with(
                $psrRequest,
                [
                    'query' => [
                        'countryCode' => 'UA'
                    ],
                    'json' => [
                        'countryCode' => 'UA'
                    ]
                ]
            )
            ->willReturn($this->response);

        $client = new Client(
            $this->createMock(ConfigProvider::class),
            $clientInterface
        );

        $client->request($request);
    }
}
