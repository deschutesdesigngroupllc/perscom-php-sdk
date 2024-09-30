<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateQualificationRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
