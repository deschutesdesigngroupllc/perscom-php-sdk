<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetQualificationRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
