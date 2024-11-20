<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Contracts\Searchable;
use Perscom\Data\FilterObject;
use Perscom\Data\ResourceObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Statuses\BatchCreateStatusRequest;
use Perscom\Http\Requests\Statuses\BatchDeleteStatusRequest;
use Perscom\Http\Requests\Statuses\BatchUpdateStatusRequest;
use Perscom\Http\Requests\Statuses\CreateStatusRequest;
use Perscom\Http\Requests\Statuses\DeleteStatusRequest;
use Perscom\Http\Requests\Statuses\GetStatusesRequest;
use Perscom\Http\Requests\Statuses\GetStatusRequest;
use Perscom\Http\Requests\Statuses\SearchStatusesRequest;
use Perscom\Http\Requests\Statuses\UpdateStatusRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class StatusResource extends Resource implements ResourceContract, Searchable
{
    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetStatusesRequest($include, $page, $limit));
    }

    /**
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  ScopeObject|array<ScopeObject>|null  $scope
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function search(
        ?string $value = null,
        SortObject|array|null $sort = null,
        FilterObject|array|null $filter = null,
        ScopeObject|array|null $scope = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchStatusesRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetStatusRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateStatusRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateStatusRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteStatusRequest($id));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchCreate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchCreateStatusRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchUpdate(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchUpdateStatusRequest($data));
    }

    /**
     * @param  ResourceObject|array<ResourceObject>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function batchDelete(ResourceObject|array $data): Response
    {
        return $this->connector->send(new BatchDeleteStatusRequest($data));
    }
}
