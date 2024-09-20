<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAssignmentRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
