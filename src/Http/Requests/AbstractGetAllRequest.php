<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Illuminate\Support\Arr;
use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractGetAllRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     */
    public function __construct(public string|array $include = [], public int $page = 1, public int $limit = 20)
    {
        $this->include = Arr::wrap($this->include);
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return $this->getResource();
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
        $query = [
            'limit' => $this->limit,
            'page' => $this->page,
        ];

        if (filled($this->include)) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }
}
