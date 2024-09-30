<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateUserRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'users';
    }
}
