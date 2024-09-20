<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractGetRequest;

class GetUserRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'users';
    }
}
