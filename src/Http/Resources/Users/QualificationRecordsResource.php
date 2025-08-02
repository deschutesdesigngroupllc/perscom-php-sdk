<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\Crudable;
use Perscom\Http\Requests\Users\QualificationRecords\CreateUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\DeleteUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\GetUserQualificationRecordRequest;
use Perscom\Http\Requests\Users\QualificationRecords\GetUserQualificationRecordsRequest;
use Perscom\Http\Requests\Users\QualificationRecords\UpdateUserQualificationRecordRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class QualificationRecordsResource extends Resource implements Crudable
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
        return $this->connector->send(new GetUserQualificationRecordsRequest($this->relationId, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetUserQualificationRecordRequest($this->relationId, $id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserQualificationRecordRequest($this->relationId, $data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserQualificationRecordRequest($this->relationId, $id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserQualificationRecordRequest($this->relationId, $id));
    }
}
