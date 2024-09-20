<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Forms\CreateFormRequest;
use Perscom\Http\Requests\Forms\DeleteFormRequest;
use Perscom\Http\Requests\Forms\GetFormRequest;
use Perscom\Http\Requests\Forms\GetFormsRequest;
use Perscom\Http\Requests\Forms\SearchFormsRequest;
use Perscom\Http\Requests\Forms\UpdateFormRequest;
use Saloon\Contracts\Response;

class FormResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetFormsRequest($include, $page, $limit));
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
        return $this->connector->send(new SearchFormsRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetFormRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateFormRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateFormRequest($id, $data));
    }

    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteFormRequest($id));
    }
}
