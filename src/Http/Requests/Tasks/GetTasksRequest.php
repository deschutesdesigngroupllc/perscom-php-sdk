<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetTasksRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'tasks';
    }
}
