<?php

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteTaskRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'tasks';
    }
}
