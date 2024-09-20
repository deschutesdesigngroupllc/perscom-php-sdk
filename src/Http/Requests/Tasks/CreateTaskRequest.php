<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateTaskRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'tasks';
    }
}
