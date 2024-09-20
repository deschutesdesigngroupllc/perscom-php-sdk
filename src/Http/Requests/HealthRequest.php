<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Perscom\Support\Helpers\ApiUrl;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class HealthRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return ApiUrl::withoutApiVersion(fn (string $baseUrl): string => "$baseUrl/health");
    }
}
