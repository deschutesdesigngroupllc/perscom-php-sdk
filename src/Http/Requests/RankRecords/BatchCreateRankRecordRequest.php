<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateRankRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
