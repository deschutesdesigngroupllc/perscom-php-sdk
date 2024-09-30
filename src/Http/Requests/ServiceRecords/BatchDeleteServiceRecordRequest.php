<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteServiceRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
