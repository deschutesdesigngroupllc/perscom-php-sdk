<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Qualifications\CreateQualificationRequest;
use Perscom\Http\Requests\Qualifications\DeleteQualificationRequest;
use Perscom\Http\Requests\Qualifications\GetQualificationRequest;
use Perscom\Http\Requests\Qualifications\GetQualificationsRequest;
use Perscom\Http\Requests\Qualifications\SearchQualificationsRequest;
use Perscom\Http\Requests\Qualifications\UpdateQualificationRequest;
use Saloon\Contracts\Response;

class QualificationResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetQualificationsRequest($include, $page, $limit));
    }

    /**
     * @param  string|null  $value
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  ScopeObject|array<ScopeObject>|null  $scope
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     * @return Response
     */
    public function search(
        string $value = null,
        mixed $sort = null,
        mixed $filter = null,
        mixed $scope = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchQualificationsRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  int  $id
     * @param  string|array<string>  $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetQualificationRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateQualificationRequest($data));
    }

    /**
     * @param  int  $id
     * @param  array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateQualificationRequest($id, $data));
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteQualificationRequest($id));
    }
}
