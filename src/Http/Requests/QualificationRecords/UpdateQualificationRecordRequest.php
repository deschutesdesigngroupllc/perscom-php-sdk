<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateQualificationRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
