<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractDeleteRequest;

class DeleteTrainingRecordRequest extends AbstractDeleteRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
