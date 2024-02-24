<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractRelationalDeleteRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * @param int $relationId
     * @param int $resourceId
     */
    public function __construct(public int $relationId, public int $resourceId)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "{$this->getResource($this->relationId)}/$this->resourceId";
    }

    /**
     * @param int $relationId
     * @return string
     */
    abstract protected function getResource(int $relationId): string;
}
