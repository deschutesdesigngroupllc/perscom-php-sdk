<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateUserRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'users';
    }
}
