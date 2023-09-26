<?php

namespace Perscom;

use Saloon\Contracts\PendingRequest;
use Saloon\Http\Auth\TokenAuthenticator;

class PerscomAuthenticator extends TokenAuthenticator
{
    public function __construct(protected string $apiKey, protected string $perscomId)
    {
        parent::__construct($this->apiKey);
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('X-Perscom-Id', $this->perscomId);
    }
}