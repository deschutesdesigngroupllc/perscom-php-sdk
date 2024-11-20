<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteSpecialtyRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'specialties';
    }
}
