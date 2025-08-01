<?php

declare(strict_types=1);

namespace Perscom\Traits;

use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Search\SearchRequest;
use Perscom\Http\Resources\Resource;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

/**
 * @mixin Resource
 */
trait HasSearchEndpoints
{
    abstract public function getResource(): string;

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
        return $this->connector->send(new SearchRequest(
            resource: $this->getResource(),
            value: $value,
            sort: $sort,
            filter: $filter,
            scope: $scope,
            include: $include,
            page: $page,
            limit: $limit
        ));
    }
}
