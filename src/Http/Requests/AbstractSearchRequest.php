<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Illuminate\Support\Arr;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

abstract class AbstractSearchRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  string|null  $value
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  string|array  $include
     * @param  int  $limit
     * @param  int  $page
     */
    public function __construct(
        public ?string $value = null,
        public mixed $sort = null,
        public mixed $filter = null,
        public string|array $include = [],
        public int $page = 1,
        public int $limit = 20,
    ) {
        $this->sort = Arr::wrap($this->sort);
        $this->filter = Arr::wrap($this->filter);
        $this->include = Arr::wrap($this->include);
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "{$this->getResource()}/search";
    }

    /**
     * @return string
     */
    abstract protected function getResource(): string;

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

        return $body;
    }
}
