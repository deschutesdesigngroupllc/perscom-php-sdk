<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\RankRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteRankRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'rank-records';
    }
}
