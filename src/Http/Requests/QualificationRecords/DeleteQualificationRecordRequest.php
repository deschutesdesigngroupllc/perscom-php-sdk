<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteQualificationRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
