<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Comments;

use Perscom\Http\Requests\AbstractSearchRequest;

class SearchCommentsRequest extends AbstractSearchRequest
{
    protected function getResource(): string
    {
        return 'comments';
    }
}
