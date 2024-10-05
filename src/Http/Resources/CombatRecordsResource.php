<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\ResourceContract;
use Perscom\Data\ResourceObject;
use Perscom\Http\Requests\CombatRecords\BatchCreateCombatRecordRequest;
use Perscom\Http\Requests\CombatRecords\BatchDeleteCombatRecordRequest;
use Perscom\Http\Requests\CombatRecords\BatchUpdateCombatRecordRequest;
use Perscom\Http\Requests\CombatRecords\CreateCombatRecordRequest;
use Perscom\Http\Requests\CombatRecords\DeleteCombatRecordRequest;
use Perscom\Http\Requests\CombatRecords\GetCombatRecordRequest;
use Perscom\Http\Requests\CombatRecords\GetCombatRecordsRequest;
use Perscom\Http\Requests\CombatRecords\UpdateCombatRecordRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;

class CombatRecordsResource extends Resource implements Batchable, ResourceContract
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
        return $this->connector->send(new GetCombatRecordsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetCombatRecordRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateCombatRecordRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateCombatRecordRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteCombatRecordRequest($id));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchCreate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchCreateCombatRecordRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchUpdate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchUpdateCombatRecordRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchDelete(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchDeleteCombatRecordRequest($data));
    }
}
