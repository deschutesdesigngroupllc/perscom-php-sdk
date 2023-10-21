<?php

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAnnouncementRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'announcements';
    }
}
