<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateSpecialtyRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'specialties';
    }
}
