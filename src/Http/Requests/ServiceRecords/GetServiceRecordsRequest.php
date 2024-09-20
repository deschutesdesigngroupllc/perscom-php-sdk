<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetServiceRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
