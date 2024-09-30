<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteAwardRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
