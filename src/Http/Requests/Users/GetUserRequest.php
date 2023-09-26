<?php

namespace Perscom\Http\Requests\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserRequest extends Request
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
        return "users/{$this->id}";
    }
}
