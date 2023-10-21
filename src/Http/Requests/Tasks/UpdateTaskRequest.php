<?php

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateTaskRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'tasks';
    }
}
