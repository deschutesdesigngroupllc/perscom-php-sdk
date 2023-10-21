<?php

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetSpecialtiesRequest extends AbstractGetAllRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'specialties';
    }
}
