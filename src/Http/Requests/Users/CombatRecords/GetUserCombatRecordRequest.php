<?php

namespace Perscom\Http\Requests\Users\CombatRecords;

use Perscom\Http\Requests\AbstractRelationalGetRequest;

class GetUserCombatRecordRequest extends AbstractRelationalGetRequest
{
    /**
     * @param int $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/combat-records";
    }
}
