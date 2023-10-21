<?php

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetQualificationsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'qualifications';
    }
}
