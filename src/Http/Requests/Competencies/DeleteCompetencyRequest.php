<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Competencies;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteCompetencyRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'competencies';
    }
}
