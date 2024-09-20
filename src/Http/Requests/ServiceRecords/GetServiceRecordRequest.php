<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetServiceRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
