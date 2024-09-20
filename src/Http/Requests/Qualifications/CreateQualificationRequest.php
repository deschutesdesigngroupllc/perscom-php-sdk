<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateQualificationRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'qualifications';
    }
}
