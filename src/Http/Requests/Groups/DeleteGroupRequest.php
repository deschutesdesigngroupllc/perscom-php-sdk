<?php

namespace Perscom\Http\Requests\Groups;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class DeleteGroupRequest extends Request
{
    protected Method $method = Method::DELETE;

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
        return "groups/{$this->id}";
    }
}
