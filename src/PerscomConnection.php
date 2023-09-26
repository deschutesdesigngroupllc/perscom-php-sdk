<?php

namespace Perscom;

use Perscom\Http\Resources\UserResource;
use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;

class PerscomConnection extends Connector
{
    use AcceptsJson;
    use HasRateLimits;

    /**
     * @param string $apiKey
     * @param string $perscomId
     */
    public function __construct(protected string $apiKey, protected string $perscomId)
    {
        //
    }

    /**
     * @return Authenticator|null
     */
    protected function defaultAuth(): ?Authenticator
    {
        return new PerscomAuthenticator($this->apiKey, $this->perscomId);
    }

    /**
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.perscom.io/v1';
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultHeaders(): array
    {
        return [
            'X-Perscom-Sdk' => true,
            'X-Perscom-Sdk-Version' => '1.0.0',
        ];
    }

    /**
     * @return UserResource
     */
    public function users(): UserResource
    {
        return new UserResource($this);
    }

    /**
     * @return array<Limit>
     */
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
