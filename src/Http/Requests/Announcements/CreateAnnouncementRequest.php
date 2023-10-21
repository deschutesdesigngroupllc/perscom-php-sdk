<?php

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAnnouncementRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'announcements';
    }
}
