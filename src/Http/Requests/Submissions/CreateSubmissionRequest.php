<?php

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateSubmissionRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'submissions';
    }
}
