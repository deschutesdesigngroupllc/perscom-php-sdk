<?php

namespace Perscom\Http\Requests\Users\CombatRecords;

use Perscom\Http\Requests\AbstractRelationalCreateRequest;

class CreateUserCombatRecordRequest extends AbstractRelationalCreateRequest
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
