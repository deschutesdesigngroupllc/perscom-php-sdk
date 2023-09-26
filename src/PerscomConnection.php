<?php

namespace Perscom;

use Perscom\Exceptions\TenantCouldNotBeIdentifiedException;
use Perscom\Exceptions\AuthenticationException;
use Perscom\Http\Resources\UserResource;
use Perscom\Traits\HasLogging;
use Saloon\Contracts\Response;
use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class PerscomConnection extends Connector
{
    use AlwaysThrowOnErrors;
    use AcceptsJson;
    use HasLogging;
    use HasRateLimits;

    /**
     * @param string $apiKey
     * @param string $perscomId
     */
    public function __construct(protected string $apiKey, protected string $perscomId)
    {
        $this->withTokenAuth($this->apiKey);
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
            'X-Perscom-Id' => $this->perscomId
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

    /**
     * @return RateLimitStore
     */
    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new MemoryStore();
    }

    /**
     * @param Response $response
     * @param Throwable|null $senderException
     * @return Throwable|null
     */
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        if ($response->json('error.type') === 'TenantCouldNotBeIdentified') {
            return new TenantCouldNotBeIdentifiedException();
        }

        if ($response->json('error.type') === 'AuthenticationException') {
            return new AuthenticationException();
        }

        return parent::getRequestException($response, $senderException);
    }
}
