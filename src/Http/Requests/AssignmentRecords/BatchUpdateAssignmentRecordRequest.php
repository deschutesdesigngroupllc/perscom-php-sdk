<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateAssignmentRecordRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
