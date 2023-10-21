<?php

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAnnouncementsRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'announcements';
    }
}
