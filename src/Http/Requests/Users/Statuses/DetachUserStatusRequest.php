<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Statuses;

use Perscom\Http\Requests\AbstractRelationalDetachRequest;

class DetachUserStatusRequest extends AbstractRelationalDetachRequest
{
    /**
     * @param  int  $relationId
     * @return string
     */
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/status-records";
    }
}
