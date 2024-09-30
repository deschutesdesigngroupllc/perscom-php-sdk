<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateRankRecordRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
