<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchTasksRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'tasks';
    }
}
