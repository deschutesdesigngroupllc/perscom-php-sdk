<?php

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractGetRequest;

class GetSubmissionRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'submissions';
    }
}
