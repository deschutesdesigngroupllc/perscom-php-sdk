<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Http\Requests\Roster\GetRosterGroupRequest;
use Perscom\Http\Requests\Roster\GetRosterRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class RosterResource extends Resource
{
    /**
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetRosterRequest($include, $page, $limit));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function group(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetRosterGroupRequest($id, $include));
    }
}
