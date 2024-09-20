<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractGetRequest;

class GetSpecialtyRequest extends AbstractGetRequest
{
    public function getResource(): string
    {
        return 'specialties';
    }
}
