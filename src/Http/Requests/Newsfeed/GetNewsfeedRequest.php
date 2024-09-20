<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Newsfeed;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetNewsfeedRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'newsfeed';
    }
}
