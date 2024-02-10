<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Positions\CreatePositionRequest;
use Perscom\Http\Requests\Positions\DeletePositionRequest;
use Perscom\Http\Requests\Positions\GetPositionRequest;
use Perscom\Http\Requests\Positions\GetPositionsRequest;
use Perscom\Http\Requests\Positions\SearchPositionsRequest;
use Perscom\Http\Requests\Positions\UpdatePositionRequest;
use Saloon\Contracts\Response;

class PositionResource extends Resource implements ResourceContract
{
    /**
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetPositionsRequest($include, $page, $limit));
    }

    /**
     * @param string|null $value
     * @param SortObject|array<SortObject>|null $sort
     * @param FilterObject|array<FilterObject>|null $filter
     * @param string|array<string> $include
     * @return Response
     */
    public function search(?string $value = null, mixed $sort = null, mixed $filter = null, string|array $include = []): Response
    {
        return $this->connector->send(new SearchPositionsRequest($value, $sort, $filter, $include));
    }

    /**
     * @param int $id
     * @param string|array<string> $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetPositionRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreatePositionRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdatePositionRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeletePositionRequest($id));
    }
}
