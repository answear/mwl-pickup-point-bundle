<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Request\Transformer;

use Answear\MwlBundle\Request\Request;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;

readonly class RequestTransformer
{
    private const SERVICE_URI = '/mwl';

    public static function transform(Request $request): HttpRequest
    {
        $baseUri = new Uri(self::SERVICE_URI . $request->getEndpoint());

        return new HttpRequest(
            $request->getMethod(),
            $baseUri,
        );
    }
}
