<?php

declare(strict_types=1);

namespace Perscom\Http\Requests;

class SettingsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'settings';
    }
}
