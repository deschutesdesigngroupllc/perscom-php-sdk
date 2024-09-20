<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateQualificationRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'qualifications';
    }
}
