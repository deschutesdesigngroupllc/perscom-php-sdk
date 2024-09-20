<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateTaskRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'tasks';
    }
}
