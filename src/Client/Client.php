<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Client;

use Answear\MwlBundle\ConfigProvider;
use Answear\MwlBundle\Exception\ServiceUnavailableException;
use Answear\MwlBundle\Request\Request;
use Answear\MwlBundle\Request\Transformer\RequestTransformer;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private const CONNECTION_TIMEOUT = 10;
    private const TIMEOUT = 60;

    private ClientInterface $client;

    public function __construct(
        ConfigProvider $configuration,
        ?ClientInterface $client = null,
    ) {
        $this->client = $client ?? new GuzzleClient($configuration->getRequestHeaders() + ['timeout' => self::TIMEOUT, 'connect_timeout' => self::CONNECTION_TIMEOUT]);
    }

    public function request(Request $request): ResponseInterface
    {
        $psrRequest = RequestTransformer::transform($request);
        $options = [];

        if (!empty($request->getQueryParams())) {
            $options['query'] = $request->getQueryParams();
        }

        if (!empty($request->getBody())) {
            $options['json'] = $request->getBody();
        }

        try {
            $response = $this->client->send($psrRequest, $options);

            if ($response->getBody()->isSeekable()) {
                $response->getBody()->rewind();
            }
        } catch (GuzzleException $e) {
            throw new ServiceUnavailableException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }
}
