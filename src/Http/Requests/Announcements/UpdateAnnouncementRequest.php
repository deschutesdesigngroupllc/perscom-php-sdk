<?php

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAnnouncementRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'announcements';
    }
}
