<?php

namespace Perscom\Http\Requests\Specialties;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteSpecialtyRequest extends AbstractDeleteRequest
{
    /**
     * @return string
     */
    public function getResource(): string
    {
        return 'specialties';
    }
}
