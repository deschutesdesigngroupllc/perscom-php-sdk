<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteTaskRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'tasks';
    }
}
