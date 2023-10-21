<?php

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractGetRequest;

class GetSpecialtyRequest extends AbstractGetRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'specialties';
    }
}
