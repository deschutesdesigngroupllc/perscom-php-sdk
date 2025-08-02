<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Http\Requests\Crud\GetAllRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class SettingsResource extends Resource
{
    /**
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetAllRequest('settings', $include, $page, $limit));
    }
}
