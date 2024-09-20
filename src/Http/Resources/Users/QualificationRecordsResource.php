<?php

declare(strict_types=1);

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
    public function __construct(protected Connector $connector, protected int $relationId)
    {
        parent::__construct($connector);
    }

    /**
     * @param  string|array<string>  $include
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUserQualificationRecordsRequest($this->relationId, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetUserQualificationRecordRequest($this->relationId, $id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserQualificationRecordRequest($this->relationId, $data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserQualificationRecordRequest($this->relationId, $id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserQualificationRecordRequest($this->relationId, $id));
    }
}
