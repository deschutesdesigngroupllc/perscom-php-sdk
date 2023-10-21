<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Submissions;

use Perscom\RequestType\AbstractSearchRequest;

class SearchSubmissionsRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'submissions';
    }
}
