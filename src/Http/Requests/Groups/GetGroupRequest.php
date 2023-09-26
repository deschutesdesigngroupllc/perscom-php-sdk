<?php

namespace Perscom\Http\Requests\Groups;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetGroupRequest extends Request
{
    protected Method $method = Method::GET;

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
        return "groups/{$this->id}";
    }
}
