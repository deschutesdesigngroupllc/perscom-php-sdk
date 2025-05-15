<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractBatchCreateRequest;

class BatchCreateTrainingRecordRequest extends AbstractBatchCreateRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
