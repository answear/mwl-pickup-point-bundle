<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Client;

use Answear\MwlBundle\Request\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;

readonly class RequestTransformer
{
    private const SERVICE_URI = '/mwl';

    public function __construct(
        private Serializer $serializer,
    ) {
    }

    public function transform(Request $request): HttpRequest
    {
        return new HttpRequest(
            $request->getMethod(),
            new Uri(self::SERVICE_URI . $request->getEndpoint()),
            [
                'Content-type' => 'application/json',
            ],
            $this->serializer->serialize($request)
        );
    }
}
