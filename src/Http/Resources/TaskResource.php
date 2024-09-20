<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Tasks\CreateTaskRequest;
use Perscom\Http\Requests\Tasks\DeleteTaskRequest;
use Perscom\Http\Requests\Tasks\GetTaskRequest;
use Perscom\Http\Requests\Tasks\GetTasksRequest;
use Perscom\Http\Requests\Tasks\SearchTasksRequest;
use Perscom\Http\Requests\Tasks\UpdateTaskRequest;
use Saloon\Contracts\Response;

class TaskResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetTasksRequest($include, $page, $limit));
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
        return $this->connector->send(new SearchTasksRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetTaskRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateTaskRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateTaskRequest($id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteTaskRequest($id));
    }
}
