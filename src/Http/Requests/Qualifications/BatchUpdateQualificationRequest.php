<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateQualificationRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'qualifications';
    }
}
