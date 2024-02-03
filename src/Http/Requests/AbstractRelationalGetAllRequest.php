<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Illuminate\Support\Arr;
use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractRelationalGetAllRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $relationId
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
     */
    public function __construct(public int $relationId, public string|array $include = [], public int $page = 1, public int $limit = 20)
    {
        $this->include = Arr::wrap($this->include);
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return $this->getResource($this->relationId);
    }

    /**
     * @param int $relationId
     * @return string
     */
    abstract protected function getResource(int $relationId): string;

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        $query = [
            'limit' => $this->limit,
            'page' => $this->page,
        ];

        if ($this->include) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }
}
