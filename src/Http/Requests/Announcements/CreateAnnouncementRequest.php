<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateAnnouncementRequest extends AbstractCreateRequest
{
    public function getResource(): string
    {
        return 'announcements';
    }
}
