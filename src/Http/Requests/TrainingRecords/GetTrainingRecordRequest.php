<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractGetRequest;

class GetTrainingRecordRequest extends AbstractGetRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
