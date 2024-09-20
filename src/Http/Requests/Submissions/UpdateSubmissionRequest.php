<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateSubmissionRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'submissions';
    }
}
