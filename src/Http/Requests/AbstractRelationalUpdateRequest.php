<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

abstract class AbstractRelationalUpdateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(public int $relationId, public int $resourceId, public array $data)
    {
        //
    }

    abstract protected function getResource(int $relationId): string;

    public function resolveEndpoint(): string
    {
        return "{$this->getResource($this->relationId)}/$this->resourceId";
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data;
    }
}
