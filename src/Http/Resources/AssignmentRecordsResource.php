<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\AssignmentRecords\CreateAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\DeleteAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordRequest;
use Perscom\Http\Requests\AssignmentRecords\GetAssignmentRecordsRequest;
use Perscom\Http\Requests\AssignmentRecords\UpdateAssignmentRecordRequest;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class AssignmentRecordsResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasSearchEndpoints;

    public function __construct(protected Connector $connector)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return 'assignment-records';
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
}
