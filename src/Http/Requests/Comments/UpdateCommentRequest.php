<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Comments;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateCommentRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'comments';
    }
}
