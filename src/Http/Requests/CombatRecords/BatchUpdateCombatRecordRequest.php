<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateCombatRecordRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
