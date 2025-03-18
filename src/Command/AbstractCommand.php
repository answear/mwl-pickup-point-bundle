<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Command;

use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

abstract readonly class AbstractCommand
{
    protected function getBody(ResponseInterface $response): array
    {
        $body = $response->getBody()->getContents();

        if (empty($body)) {
            throw new \RuntimeException('Empty response.');
        }
        $decoded = \json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        Assert::isArray($decoded);

        return $decoded;
    }
}
