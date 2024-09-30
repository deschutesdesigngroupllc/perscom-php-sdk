<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateAwardRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
