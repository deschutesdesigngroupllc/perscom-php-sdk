<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractUpdateRequest;

class UpdateTrainingRecordRequest extends AbstractUpdateRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
