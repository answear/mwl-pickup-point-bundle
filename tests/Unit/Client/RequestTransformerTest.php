<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Tests\Unit\Client;

use Answear\MwlBundle\Request\GetPickupPointsRequest;
use Answear\MwlBundle\Request\Request;
use Answear\MwlBundle\Request\Transformer\RequestTransformer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequestTransformerTest extends TestCase
{
    #[Test]
    public function requestTransformed(): void
    {
        $request = new GetPickupPointsRequest();

        $httpRequest = RequestTransformer::transform($request);

        $this->assertSame($request->getMethod(), $httpRequest->getMethod());
        $this->assertSame($this->expectedPath($request), $httpRequest->getUri()->getPath());
    }

    private function expectedPath(Request $request): string
    {
        return '/mwl' . $request->getEndpoint();
    }
}
