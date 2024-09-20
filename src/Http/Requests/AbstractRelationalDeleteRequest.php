<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractRelationalDeleteRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(public int $relationId, public int $resourceId)
    {
        //
    }

    abstract protected function getResource(int $relationId): string;

    public function resolveEndpoint(): string
    {
        return "{$this->getResource($this->relationId)}/$this->resourceId";
    }
}
