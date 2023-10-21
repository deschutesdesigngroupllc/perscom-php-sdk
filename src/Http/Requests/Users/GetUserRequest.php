<?php

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractGetRequest;

class GetUserRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'users';
    }
}
