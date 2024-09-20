<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateRankRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
