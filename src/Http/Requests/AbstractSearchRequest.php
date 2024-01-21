<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

abstract class AbstractSearchRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param array<string, mixed> $data
     * @param array<string> $include
     */
    public function __construct(public array $data, public array $include = [])
    {
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "{$this->getResource()}/search";
    }

    protected function defaultQuery(): array
    {
        $query = [];

        if ($this->include) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    abstract protected function getResource(): string;
}
