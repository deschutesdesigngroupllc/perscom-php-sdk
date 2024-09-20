<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAwardRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
