<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Crud;

use Illuminate\Support\Arr;
use Override;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  string|array<string>  $include
     */
    public function __construct(
        public string $resource,
        public int $id,
        public string|array $include = []
    ) {
        $this->include = Arr::wrap($this->include);
    }

    #[Override]
    public function resolveEndpoint(): string
    {
        return sprintf('%s/%d', $this->resource, $this->id);
    }

    /**
     * @return array<string, mixed>
     */
    #[Override]
    protected function defaultQuery(): array
    {
        $query = [];

        if (filled($this->include)) {
            $query['include'] = implode(',', (array) $this->include);
        }

        return $query;
    }
}
