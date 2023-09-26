<?php

namespace Perscom\Http\Requests\Users;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetUsersRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return 'users';
    }
}
