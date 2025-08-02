<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\AwardRecords\CreateAwardRecordRequest;
use Perscom\Http\Requests\AwardRecords\DeleteAwardRecordRequest;
use Perscom\Http\Requests\AwardRecords\GetAwardRecordRequest;
use Perscom\Http\Requests\AwardRecords\GetAwardRecordsRequest;
use Perscom\Http\Requests\AwardRecords\UpdateAwardRecordRequest;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class AwardRecordsResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasSearchEndpoints;

    public function __construct(protected Connector $connector)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return 'award-records';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetAwardRecordsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetAwardRecordRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateAwardRecordRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateAwardRecordRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteAwardRecordRequest($id));
    }
}
