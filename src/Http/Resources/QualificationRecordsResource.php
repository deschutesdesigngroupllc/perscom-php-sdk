<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\QualificationRecords\CreateQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\DeleteQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\GetQualificationRecordRequest;
use Perscom\Http\Requests\QualificationRecords\GetQualificationRecordsRequest;
use Perscom\Http\Requests\QualificationRecords\UpdateQualificationRecordRequest;
use Perscom\Traits\HasBatchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class QualificationRecordsResource extends Resource implements Batchable, ResourceContract
{
    use HasBatchEndpoints;

    public function __construct(protected Connector $connector)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return 'qualification-records';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetQualificationRecordsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetQualificationRecordRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateQualificationRecordRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateQualificationRecordRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteQualificationRecordRequest($id));
    }
}
