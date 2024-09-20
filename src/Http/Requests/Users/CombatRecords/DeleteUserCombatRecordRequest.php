<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\CombatRecords;

use Perscom\Http\Requests\AbstractRelationalDeleteRequest;

class DeleteUserCombatRecordRequest extends AbstractRelationalDeleteRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/combat-records";
    }
}
