<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Crud;

use Override;
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

    #[Override]
    public function resolveEndpoint(): string
    {
        return sprintf('%s/%d', $this->resource, $this->id);
    }
}
