<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Comments;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCommentRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'comments';
    }
}
