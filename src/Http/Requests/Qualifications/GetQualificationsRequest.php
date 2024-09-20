<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetQualificationsRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'qualifications';
    }
}
