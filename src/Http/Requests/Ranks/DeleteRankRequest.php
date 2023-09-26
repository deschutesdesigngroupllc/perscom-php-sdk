<?php

namespace Perscom\Http\Requests\Ranks;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteRankRequest extends Request
{
    protected Method $method = Method::DELETE;

    /**
     * @param int $id
     */
    public function __construct(protected int $id)
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
