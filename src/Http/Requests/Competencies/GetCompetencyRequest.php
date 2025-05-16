<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Competencies;

use Perscom\Http\Requests\AbstractGetRequest;

class GetCompetencyRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'competencies';
    }
}
