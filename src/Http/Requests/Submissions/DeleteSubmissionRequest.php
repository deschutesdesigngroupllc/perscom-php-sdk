<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteSubmissionRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'submissions';
    }
}
