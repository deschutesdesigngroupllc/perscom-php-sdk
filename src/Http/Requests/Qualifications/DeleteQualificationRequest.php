<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Qualifications;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteQualificationRequest extends AbstractDeleteRequest
{
    public function getResource(): string
    {
        return 'qualifications';
    }
}
