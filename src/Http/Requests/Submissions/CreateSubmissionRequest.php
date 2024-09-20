<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateSubmissionRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'submissions';
    }
}
