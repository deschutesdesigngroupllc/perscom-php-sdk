<?php

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteQualificationRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'qualifications';
    }
}
