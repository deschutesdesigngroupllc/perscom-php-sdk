<?php

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateSpecialtyRequest extends AbstractUpdateRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'specialties';
    }
}
