<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Http\Requests\HealthRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class HealthResource extends Resource
{
    /**
     * @throws FatalRequestException|RequestException
     */
    public function get(): Response
    {
        return $this->connector->send(new HealthRequest);
    }
}
