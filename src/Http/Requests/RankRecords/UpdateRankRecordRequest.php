<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateRankRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
