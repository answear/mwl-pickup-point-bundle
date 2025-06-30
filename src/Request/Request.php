<?php

declare(strict_types=1);

namespace Answear\MwlBundle\Request;

abstract readonly class Request
{
    abstract public function getEndpoint(): string;

    abstract public function getMethod(): string;

    public function getQueryParams(): array {
        return [];
    }

    public function getBody(): array {
        return [];
    }
}
