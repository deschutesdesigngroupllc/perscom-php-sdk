<?php

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteSubmissionRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'submissions';
    }
}
