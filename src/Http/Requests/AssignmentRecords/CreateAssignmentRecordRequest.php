<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAssignmentRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
