<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateQualificationRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'qualifications';
    }
}
