<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Cache;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ClearCacheRequest extends Request
{
    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/cache';
    }
}
