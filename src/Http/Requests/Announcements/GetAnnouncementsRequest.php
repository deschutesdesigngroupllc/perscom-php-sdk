<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Announcements;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetAnnouncementsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'announcements';
    }
}
