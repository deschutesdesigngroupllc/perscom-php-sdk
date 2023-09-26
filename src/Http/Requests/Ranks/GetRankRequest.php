<?php

namespace Perscom\Http\Requests\Ranks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRankRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $id
     */
    public function __construct(public int $id)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "ranks/{$this->id}";
    }
}
