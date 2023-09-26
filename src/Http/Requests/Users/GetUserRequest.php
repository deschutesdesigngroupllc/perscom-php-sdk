<?php

namespace Perscom\Http\Requests\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUserRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(protected int $id)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return "users/{$this->id}";
    }
}