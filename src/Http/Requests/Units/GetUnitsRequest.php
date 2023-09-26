<?php

namespace Perscom\Http\Requests\Units;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUnitsRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $page
     * @param int $limit
     */
    public function __construct(public int $page = 1, public int $limit = 20)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return 'units';
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
