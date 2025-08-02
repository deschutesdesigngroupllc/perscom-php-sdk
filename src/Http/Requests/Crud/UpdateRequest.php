<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Crud;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class UpdateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    /**
     * @param  array<string, mixed>  $data
     */
    public function __construct(
        public string $resource,
        public int $id,
        public array $data
    ) {
        //
    }

    public function resolveEndpoint(): string
    {
        return "{$this->resource}/{$this->id}";
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data;
    }
}
