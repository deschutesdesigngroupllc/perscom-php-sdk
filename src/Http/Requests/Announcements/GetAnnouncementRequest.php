<?php

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAnnouncementRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'announcements';
    }
}
