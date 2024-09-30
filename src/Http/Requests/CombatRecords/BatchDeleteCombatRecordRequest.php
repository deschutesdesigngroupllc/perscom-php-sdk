<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteCombatRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
