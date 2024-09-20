<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCombatRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
