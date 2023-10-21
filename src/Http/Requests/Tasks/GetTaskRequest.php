<?php

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractGetRequest;

class GetTaskRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'tasks';
    }
}
