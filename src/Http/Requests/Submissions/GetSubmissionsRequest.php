<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetSubmissionsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'submissions';
    }
}
