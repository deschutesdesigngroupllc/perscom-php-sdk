<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractGetRequest;

class GetAnnouncementRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'announcements';
    }
}
