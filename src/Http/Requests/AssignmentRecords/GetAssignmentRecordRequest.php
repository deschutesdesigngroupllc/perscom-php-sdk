<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAssignmentRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
