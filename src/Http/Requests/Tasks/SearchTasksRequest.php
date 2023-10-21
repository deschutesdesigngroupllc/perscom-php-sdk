<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Tasks;

use Perscom\RequestType\AbstractSearchRequest;

class SearchTasksRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'tasks';
    }
}
