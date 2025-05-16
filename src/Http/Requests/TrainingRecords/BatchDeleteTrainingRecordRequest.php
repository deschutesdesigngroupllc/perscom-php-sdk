<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\TrainingRecords;

use Perscom\Http\Requests\AbstractBatchDeleteRequest;

class BatchDeleteTrainingRecordRequest extends AbstractBatchDeleteRequest
{
    protected function getResource(): string
    {
        return 'training-records';
    }
}
