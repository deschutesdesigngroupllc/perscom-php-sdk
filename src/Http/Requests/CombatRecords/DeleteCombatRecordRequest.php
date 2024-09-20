<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\CombatRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCombatRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'combat-records';
    }
}
