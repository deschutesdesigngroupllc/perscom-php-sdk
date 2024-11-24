<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Http\Requests\Cache\ClearCacheRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class CacheResource extends Resource
{
    /**
     * @throws FatalRequestException|RequestException
     */
    public function clear(): Response
    {
        return $this->connector->send(new ClearCacheRequest);
    }
}
