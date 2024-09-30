<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateQualificationRecordRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
