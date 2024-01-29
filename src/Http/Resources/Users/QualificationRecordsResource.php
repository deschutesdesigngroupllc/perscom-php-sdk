<?php

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Users\QualificationRecords\CreateUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\DeleteUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\GetUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\GetUserQualificationRecordsRequest;
use Perscom\Http\Requests\Users\QualificationRecords\UpdateUserQualificationRecordRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class QualificationRecordsResource extends Resource implements ResourceContract
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
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUserQualificationRecordsRequest($this->relationId, $include, $page, $limit));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetUserQualificationRecordRequest($this->relationId, $id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserQualificationRecordRequest($this->relationId, $data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserQualificationRecordRequest($this->relationId, $id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserQualificationRecordRequest($this->relationId, $id));
    }
}
