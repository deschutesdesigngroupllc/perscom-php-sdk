<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Competencies;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateCompetencyRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'competencies';
    }
}
