<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\QualificationRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetQualificationRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'qualification-records';
    }
}
