<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Crud;

use Illuminate\Support\Arr;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAllRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  string|array<string>  $include
     */
    public function __construct(
        public string $resource,
        public string|array $include = [],
        public int $page = 1,
        public int $limit = 20
    ) {
        $this->include = Arr::wrap($this->include);
    }

    public function resolveEndpoint(): string
    {
        return $this->resource;
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
}
