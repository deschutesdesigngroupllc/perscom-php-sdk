<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAwardRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
