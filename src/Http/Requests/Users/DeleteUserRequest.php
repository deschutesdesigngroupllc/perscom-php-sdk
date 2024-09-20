<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteUserRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'users';
    }
}
