<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateQualificationRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
