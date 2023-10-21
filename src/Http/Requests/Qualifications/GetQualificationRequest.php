<?php

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractGetRequest;

class GetQualificationRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'qualifications';
    }
}
