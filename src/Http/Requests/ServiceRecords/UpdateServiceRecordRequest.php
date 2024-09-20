<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateServiceRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
