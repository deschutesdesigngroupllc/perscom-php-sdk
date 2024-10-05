<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\ResourceContract;
use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\ServiceRecords\BatchCreateServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\BatchDeleteServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\BatchUpdateServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\CreateServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\DeleteServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\GetServiceRecordRequest;
use Perscom\Http\Requests\ServiceRecords\GetServiceRecordsRequest;
use Perscom\Http\Requests\ServiceRecords\UpdateServiceRecordRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class ServiceRecordsResource extends Resource implements Batchable, ResourceContract
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
        return $this->connector->send(new GetServiceRecordsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetServiceRecordRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateServiceRecordRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateServiceRecordRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteServiceRecordRequest($id));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchCreate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchCreateServiceRecordRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchUpdate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchUpdateServiceRecordRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchDelete(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchDeleteServiceRecordRequest($data));
    }
}
