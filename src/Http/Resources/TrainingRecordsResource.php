<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\TrainingRecords\CreateTrainingRecordRequest;
use Perscom\Http\Requests\TrainingRecords\DeleteTrainingRecordRequest;
use Perscom\Http\Requests\TrainingRecords\GetTrainingRecordRequest;
use Perscom\Http\Requests\TrainingRecords\GetTrainingRecordsRequest;
use Perscom\Http\Requests\TrainingRecords\UpdateTrainingRecordRequest;
use Perscom\Traits\HasBatchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class TrainingRecordsResource extends Resource implements Batchable, ResourceContract
{
    use HasBatchEndpoints;

    public function __construct(protected Connector $connector)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return 'training-records';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetTrainingRecordsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetTrainingRecordRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateTrainingRecordRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateTrainingRecordRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteTrainingRecordRequest($id));
    }
}
