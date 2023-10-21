<?php

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetTasksRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'tasks';
    }
}
