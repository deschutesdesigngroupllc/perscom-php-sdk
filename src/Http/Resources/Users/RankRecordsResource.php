<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\Crudable;
use Perscom\Http\Requests\Users\RankRecords\CreateUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\DeleteUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\GetUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\GetUserRankRecordsRequest;
use Perscom\Http\Requests\Users\RankRecords\UpdateUserRankRecordRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class RankRecordsResource extends Resource implements Crudable
{
    public function __construct(protected Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUserRankRecordsRequest($this->relationId, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetUserRankRecordRequest($this->relationId, $id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRankRecordRequest($this->relationId, $data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserRankRecordRequest($this->relationId, $id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserRankRecordRequest($this->relationId, $id));
    }
}
