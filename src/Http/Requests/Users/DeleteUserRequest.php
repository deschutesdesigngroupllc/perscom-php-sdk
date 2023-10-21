<?php

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteUserRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'users';
    }
}
