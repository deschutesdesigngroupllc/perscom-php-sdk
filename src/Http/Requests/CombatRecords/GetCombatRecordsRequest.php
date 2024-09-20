<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCombatRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
