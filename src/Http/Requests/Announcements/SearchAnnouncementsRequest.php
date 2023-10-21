<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Announcements;

use Perscom\RequestType\AbstractSearchRequest;

class SearchAnnouncementsRequest extends AbstractSearchRequest
{
    /**
     * @inheritDoc
     */
    protected function getResource(): string
    {
        return 'announcements';
    }
}
