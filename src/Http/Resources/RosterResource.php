<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Enums\RosterType;
use Perscom\Http\Requests\Roster\GetRosterGroupRequest;
use Perscom\Http\Requests\Roster\GetRosterRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class RosterResource extends Resource
{
    private RosterType $type = RosterType::Automatic;

    /**
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetRosterRequest($include, $page, $limit, $this->type));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function group(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetRosterGroupRequest($id, $include, $this->type));
    }

    public function getType(): RosterType
    {
        return $this->type;
    }

    public function setType(RosterType $type): RosterResource
    {
        $this->type = $type;

        return $this;
    }
}
