<?php

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateQualificationRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'qualifications';
    }
}
