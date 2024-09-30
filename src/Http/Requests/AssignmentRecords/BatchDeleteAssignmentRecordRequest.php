<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteAssignmentRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
