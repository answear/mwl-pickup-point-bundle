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
        $baseUri = new Uri(self::SERVICE_URI . $request->getEndpoint());

        if (!empty($request->getQueryParams())) {
            $queryString = http_build_query($request->getQueryParams());
            $baseUri = $baseUri->withQuery($queryString);
        }

        return new HttpRequest(
            $request->getMethod(),
            $baseUri,
            [
                'Content-type' => 'application/json',
            ],
            $this->serializer->serialize($request)
        );
    }
}
