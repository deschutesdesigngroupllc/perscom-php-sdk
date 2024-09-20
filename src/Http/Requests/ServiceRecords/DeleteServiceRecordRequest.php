<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\ServiceRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteServiceRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'service-records';
    }
}
