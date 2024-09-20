<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAwardRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
