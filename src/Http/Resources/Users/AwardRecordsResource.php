<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Users\AwardRecords\CreateUserAwardRecordRequest;
use Perscom\Http\Requests\Users\AwardRecords\DeleteUserAwardRecordRequest;
use Perscom\Http\Requests\Users\AwardRecords\GetUserAwardRecordRequest;
use Perscom\Http\Requests\Users\AwardRecords\GetUserAwardRecordsRequest;
use Perscom\Http\Requests\Users\AwardRecords\UpdateUserAwardRecordRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;

class AwardRecordsResource extends Resource implements ResourceContract
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
        return $this->connector->send(new GetUserAwardRecordsRequest($this->relationId, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetUserAwardRecordRequest($this->relationId, $id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserAwardRecordRequest($this->relationId, $data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserAwardRecordRequest($this->relationId, $id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserAwardRecordRequest($this->relationId, $id));
    }
}
