<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Crud;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRequest extends Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        public string $resource,
        public int $id
    ) {
        //
    }

    public function resolveEndpoint(): string
    {
        return "{$this->resource}/{$this->id}";
    }
}
