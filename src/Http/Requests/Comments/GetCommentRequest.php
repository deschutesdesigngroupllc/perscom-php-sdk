<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Comments;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCommentRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'comments';
    }
}
