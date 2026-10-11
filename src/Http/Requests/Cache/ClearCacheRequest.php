<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Cache;

use Override;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ClearCacheRequest extends Request
{
    protected Method $method = Method::POST;

    #[Override]
    public function resolveEndpoint(): string
    {
        return '/cache';
    }
}
