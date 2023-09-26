<?php

namespace Perscom;

use Saloon\Contracts\PendingRequest;
use Saloon\Http\Auth\TokenAuthenticator;

class PerscomAuthenticator extends TokenAuthenticator
{
    /**
     * @param string $apiKey
     * @param string $perscomId
     */
    public function __construct(protected string $apiKey, protected string $perscomId)
    {
        parent::__construct($this->apiKey);
    }

    /**
     * @param PendingRequest $pendingRequest
     * @return void
     */
    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('X-Perscom-Id', $this->perscomId);
    }
}
