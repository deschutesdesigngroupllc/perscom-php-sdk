<?php

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateTaskRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'tasks';
    }
}
