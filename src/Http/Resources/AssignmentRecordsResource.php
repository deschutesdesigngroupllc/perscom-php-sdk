<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\ResourceContract;
use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\AssignmentRecords\BatchCreateAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\BatchDeleteAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\BatchUpdateAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\CreateAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\DeleteAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordsRequest;
use Perscom\Http\Requests\AssignmentRecords\UpdateAssignmentRecordRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class AssignmentRecordsResource extends Resource implements Batchable, ResourceContract
{
    public function __construct(protected Connector $connector)
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
        return $this->connector->send(new GetAssignmentRecordsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetAssignmentRecordRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateAssignmentRecordRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateAssignmentRecordRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteAssignmentRecordRequest($id));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchCreate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchCreateAssignmentRecordRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchUpdate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchUpdateAssignmentRecordRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchDelete(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchDeleteAssignmentRecordRequest($data));
    }
}
