<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetSpecialtiesRequest extends AbstractGetAllRequest
{
    public function getResource(): string
    {
        return 'specialties';
    }
}
