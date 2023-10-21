<?php

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetSubmissionsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'submissions';
    }
}
