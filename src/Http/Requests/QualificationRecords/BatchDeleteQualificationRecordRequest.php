<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteQualificationRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
