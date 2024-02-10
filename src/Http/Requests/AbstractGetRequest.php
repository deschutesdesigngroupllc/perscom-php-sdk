<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Illuminate\Support\Arr;
use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractGetRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $id
     * @param string|array<string> $include
     */
    public function __construct(public int $id, public string|array $include = [])
    {
        $this->include = Arr::wrap($this->include);
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "{$this->getResource()}/$this->id";
    }

    /**
     * @return string
     */
    abstract protected function getResource(): string;

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        $query = [];

        if (filled($this->include)) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }
}
