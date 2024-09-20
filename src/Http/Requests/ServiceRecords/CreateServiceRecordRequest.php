<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateServiceRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
