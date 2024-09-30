<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateServiceRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
