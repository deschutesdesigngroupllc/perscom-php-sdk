<?php

declare(strict_types=1);

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
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class QualificationResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetQualificationsRequest($include, $page, $limit));
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
        return $this->connector->send(new SearchQualificationsRequest($value, $sort, $filter, $scope, $include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetQualificationRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateQualificationRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateQualificationRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteQualificationRequest($id));
    }
}
