<?php

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateSubmissionRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'submissions';
    }
}
