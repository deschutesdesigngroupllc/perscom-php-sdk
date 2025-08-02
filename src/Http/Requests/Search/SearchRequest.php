<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Search;

use Illuminate\Support\Arr;
use Perscom\Data\FilterObject;
use Perscom\Data\ScopeObject;
use Perscom\Data\SortObject;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class SearchRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  ScopeObject|array<ScopeObject>|null  $scope
     */
    public function __construct(
        public string $resource,
        public ?string $value = null,
        public SortObject|array|null $sort = null,
        public FilterObject|array|null $filter = null,
        public ScopeObject|array|null $scope = null,
        public string|array $include = [],
        public int $page = 1,
        public int $limit = 20,
    ) {
        $this->sort = Arr::wrap($this->sort);
        $this->filter = Arr::wrap($this->filter);
        $this->scope = Arr::wrap($this->scope);
        $this->include = Arr::wrap($this->include);
    }

    public function resolveEndpoint(): string
    {
        return "{$this->resource}/search";
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        $query = [
            'limit' => $this->limit,
            'page' => $this->page,
        ];

        if (filled($this->include)) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        $body = [];

        if (filled($this->value)) {
            $body['search'] = ['value' => $this->value];
        }

        if (filled($this->sort)) {
            $body['sort'] = collect($this->sort)->map(fn (SortObject $sortObject): array => $sortObject->toArray())->toArray();
        }

        if (filled($this->filter)) {
            $body['filters'] = collect($this->filter)->map(fn (FilterObject $sortObject): array => $sortObject->toArray())->toArray();
        }

        if (filled($this->scope)) {
            $body['scopes'] = collect($this->scope)->map(fn (ScopeObject $scopeObject): array => $scopeObject->toArray())->toArray();
        }

        return $body;
    }
}
