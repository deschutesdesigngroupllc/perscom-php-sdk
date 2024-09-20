<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetRankRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
