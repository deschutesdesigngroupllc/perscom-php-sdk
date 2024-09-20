<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAssignmentRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
