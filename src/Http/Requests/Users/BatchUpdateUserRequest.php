<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateUserRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'users';
    }
}
