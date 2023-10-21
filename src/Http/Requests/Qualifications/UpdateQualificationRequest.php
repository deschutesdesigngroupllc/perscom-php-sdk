<?php

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateQualificationRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'qualifications';
    }
}
