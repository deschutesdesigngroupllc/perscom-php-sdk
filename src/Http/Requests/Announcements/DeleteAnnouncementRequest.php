<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteAnnouncementRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'announcements';
    }
}
