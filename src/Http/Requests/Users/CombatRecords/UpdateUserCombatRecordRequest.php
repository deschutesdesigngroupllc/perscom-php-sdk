<?php

namespace Perscom\Http\Requests\Users\CombatRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserCombatRecordRequest extends AbstractRelationalUpdateRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/combat-records";
    }
}
