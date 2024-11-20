<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Comments;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCommentRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'comments';
    }
}
