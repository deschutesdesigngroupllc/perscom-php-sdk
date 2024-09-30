<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateAssignmentRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
