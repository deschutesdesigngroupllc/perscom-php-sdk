<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AssignmentRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAssignmentRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'assignment-records';
    }
}
