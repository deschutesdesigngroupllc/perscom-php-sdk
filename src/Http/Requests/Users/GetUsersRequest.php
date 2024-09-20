<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetUsersRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'users';
    }
}
