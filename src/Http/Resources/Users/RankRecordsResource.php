<?php

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Users\RankRecords\CreateUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\DeleteUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\GetUserRankRecordRequest;
use Perscom\Http\Requests\Users\RankRecords\GetUserRankRecordsRequest;
use Perscom\Http\Requests\Users\RankRecords\UpdateUserRankRecordRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class RankRecordsResource extends Resource implements ResourceContract
{
    /**
     * @param Connector $connector
     * @param int $relationId
     */
    public function __construct(protected Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUserRankRecordsRequest($this->relationId, $include, $page, $limit));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetUserRankRecordRequest($this->relationId, $id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRankRecordRequest($this->relationId, $data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserRankRecordRequest($this->relationId, $id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserRankRecordRequest($this->relationId, $id));
    }
}
