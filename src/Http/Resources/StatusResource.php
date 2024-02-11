<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Statuses\CreateStatusRequest;
use Perscom\Http\Requests\Statuses\DeleteStatusRequest;
use Perscom\Http\Requests\Statuses\GetStatusesRequest;
use Perscom\Http\Requests\Statuses\GetStatusRequest;
use Perscom\Http\Requests\Statuses\SearchStatusesRequest;
use Perscom\Http\Requests\Statuses\UpdateStatusRequest;
use Saloon\Contracts\Response;

class StatusResource extends Resource implements ResourceContract
{
    /**
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetStatusesRequest($include, $page, $limit));
    }

    /**
     * @param string|null $value
     * @param SortObject|array<SortObject>|null $sort
     * @param FilterObject|array<FilterObject>|null $filter
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function search(
        ?string $value = null,
        mixed $sort = null,
        mixed $filter = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchStatusesRequest($value, $sort, $filter, $include, $page, $limit));
    }

    /**
     * @param int $id
     * @param string|array<string> $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetStatusRequest($id, $include));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateStatusRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed> $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateStatusRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteStatusRequest($id));
    }
}
