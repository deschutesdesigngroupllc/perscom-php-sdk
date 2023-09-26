<?php

namespace Perscom;

use Perscom\Http\Resources\UserResource;
use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;

class PerscomConnector extends Connector
{
    use AcceptsJson;
    use HasRateLimits;

    public function resolveBaseUrl(): string
    {
        return 'https://api.perscom.io/v1';
    }

    protected function defaultHeaders(): array
    {
        return [
            'X-Perscom-Sdk' => true,
            'X-Perscom-Sdk-Version' => '1.0.0'
        ];
    }

    public function users(): UserResource
    {
        return new UserResource($this);
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(60)->everyMinute(),
        ];
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new MemoryStore();
    }
}