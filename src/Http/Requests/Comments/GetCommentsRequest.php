<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Comments;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetCommentsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'comments';
    }
}
