<?php

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateSpecialtyRequest extends AbstractCreateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'specialties';
    }
}
