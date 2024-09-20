<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractGetRequest;

class GetTaskRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'tasks';
    }
}
