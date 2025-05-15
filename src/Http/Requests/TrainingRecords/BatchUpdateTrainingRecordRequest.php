<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractBatchUpdateRequest;

class BatchUpdateTrainingRecordRequest extends AbstractBatchUpdateRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
