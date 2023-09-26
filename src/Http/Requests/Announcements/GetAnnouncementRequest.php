<?php

namespace Perscom\Http\Requests\Announcements;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAnnouncementRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param int $id
     */
    public function __construct(protected int $id)
    {
        //
    }

    /**
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return "announcements/{$this->id}";
    }
}
