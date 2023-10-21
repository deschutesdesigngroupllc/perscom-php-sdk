<?php

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateUserRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'users';
    }
}
