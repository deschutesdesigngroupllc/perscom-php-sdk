<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteUserRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'users';
    }
}
