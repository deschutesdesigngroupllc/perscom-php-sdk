<?php

namespace Perscom\Http\Requests\Awards;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAwardsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $page
     * @param int $limit
     */
    public function __construct(protected int $page = 1, protected int $limit = 20)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return 'awards';
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        return [
            'limit' => $this->limit,
            'page' => $this->page,
        ];
    }
}