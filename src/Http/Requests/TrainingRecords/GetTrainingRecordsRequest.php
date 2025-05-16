<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractGetAllRequest;

class GetTrainingRecordsRequest extends AbstractGetAllRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
