<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
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
     * @param  string|array<string>  $include
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetPositionsRequest($include, $page, $limit));
    }

    /**
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  ScopeObject|array<ScopeObject>|null  $scope
     * @param  string|array<string>  $include
     */
    public function search(
        ?string $value = null,
        mixed $sort = null,
        mixed $filter = null,
        mixed $scope = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchPositionsRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetPositionRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreatePositionRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdatePositionRequest($id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeletePositionRequest($id));
    }
}
