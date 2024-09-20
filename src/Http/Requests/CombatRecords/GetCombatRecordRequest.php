<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCombatRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
