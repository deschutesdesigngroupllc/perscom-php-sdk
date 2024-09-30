<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteRankRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
