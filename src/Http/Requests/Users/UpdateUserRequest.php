<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateUserRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'users';
    }
}
