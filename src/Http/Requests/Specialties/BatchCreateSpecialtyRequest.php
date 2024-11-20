<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateSpecialtyRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'specialties';
    }
}
