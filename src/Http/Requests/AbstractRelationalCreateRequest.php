<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

abstract class AbstractRelationalCreateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $relationId
     * @param  array  $data
     */
    public function __construct(public int $relationId, public array $data)
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
     * @param  int  $relationId
     * @return string
     */
    abstract protected function getResource(int $relationId): string;

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data;
    }
}
