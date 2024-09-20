<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateAnnouncementRequest extends AbstractUpdateRequest
{
    public function getResource(): string
    {
        return 'announcements';
    }
}
