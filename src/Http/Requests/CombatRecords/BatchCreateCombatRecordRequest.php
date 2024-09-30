<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateCombatRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
