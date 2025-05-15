<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractCreateRequest;

class CreateTrainingRecordRequest extends AbstractCreateRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
