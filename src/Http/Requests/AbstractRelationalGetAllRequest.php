<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractRelationalGetAllRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $relationId
     * @param array $include
     * @param int $page
     * @param int $limit
     */
    public function __construct(public int $relationId, public array $include = [], public int $page = 1, public int $limit = 20)
    {
        //
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
