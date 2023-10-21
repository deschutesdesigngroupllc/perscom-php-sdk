<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

abstract class AbstractGetAllRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     */
    public function __construct(public array $include = [], public int $page = 1, public int $limit = 20)
    {
        //
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
        return [
            'include' => implode(',', $this->include),
            'limit' => $this->limit,
            'page' => $this->page,
        ];
    }
}
