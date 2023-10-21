<?php

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetUsersRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'users';
    }
}
