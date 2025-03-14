<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Tests\Unit\Client;

use Answear\MwlBundle\Client\RequestTransformer;
use Answear\MwlBundle\Client\Serializer;
use Answear\MwlBundle\ConfigProvider;
use Answear\MwlBundle\Request\GetPickupPointsRequest;
use Answear\MwlBundle\Request\Request;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RequestTransformerTest extends TestCase
{
    private RequestTransformer $transformer;
    private Serializer|MockObject $serializer;

    public function setUp(): void
    {
        parent::setUp();

        $this->serializer = $this->createMock(Serializer::class);
        $this->transformer = new RequestTransformer($this->serializer);
    }

    #[Test]
    public function requestTransformed(): void
    {
        $request = new GetPickupPointsRequest();
        $this->serializer->expects($this->once())
            ->method('serialize')
            ->with($request)
            ->willReturn('{"foo":"bar"}');

        $httpRequest = $this->transformer->transform($request);

        $this->assertSame($request->getMethod(), $httpRequest->getMethod());
        $this->assertSame($this->expectedPath($request), $httpRequest->getUri()->getPath());
        $this->assertSame(['application/json'], $httpRequest->getHeader('Content-type'));
        $this->assertSame('{"foo":"bar"}', $httpRequest->getBody()->getContents());
    }

    private function expectedPath(Request $request): string
    {
        return ConfigProvider::SERVICE_URI . $request->getEndpoint();
    }
}
