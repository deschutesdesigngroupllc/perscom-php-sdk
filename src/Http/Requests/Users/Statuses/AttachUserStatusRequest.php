<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\Statuses;

use Perscom\Http\Requests\AbstractRelationalAttachRequest;

class AttachUserStatusRequest extends AbstractRelationalAttachRequest
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
