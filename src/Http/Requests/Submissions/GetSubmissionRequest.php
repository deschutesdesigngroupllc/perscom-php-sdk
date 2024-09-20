<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractGetRequest;

class GetSubmissionRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'submissions';
    }
}
