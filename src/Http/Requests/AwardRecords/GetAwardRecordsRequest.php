<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAwardRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
