<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetRankRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
