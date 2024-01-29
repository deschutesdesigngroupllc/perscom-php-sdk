<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractRelationalGetRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $relationId
     * @param int $resourceId
     * @param array $include
     */
    public function __construct(public int $relationId, public int $resourceId, public array $include = [])
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
        $query = [];

        if ($this->include) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }
}
