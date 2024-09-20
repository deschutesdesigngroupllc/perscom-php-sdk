<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchUsersRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'users';
    }
}
