<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCombatRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
