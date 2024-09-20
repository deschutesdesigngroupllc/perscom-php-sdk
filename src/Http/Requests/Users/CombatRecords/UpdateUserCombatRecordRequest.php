<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\CombatRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserCombatRecordRequest extends AbstractRelationalUpdateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/combat-records";
    }
}
