<?php

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateUserRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'users';
    }
}
