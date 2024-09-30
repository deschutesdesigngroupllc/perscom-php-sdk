<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateAwardRecordRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
