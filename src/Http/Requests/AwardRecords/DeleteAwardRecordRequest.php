<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\AwardRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAwardRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'award-records';
    }
}
