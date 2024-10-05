<?php

declare(strict_types=1);

namespace Perscom\Contracts;

use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

interface Searchable
{
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
    ): Response;
}
