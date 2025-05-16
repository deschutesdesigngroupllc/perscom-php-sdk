<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Users\TrainingRecords;

use Perscom\Http\Requests\AbstractRelationalUpdateRequest;

class UpdateUserTrainingRecordRequest extends AbstractRelationalUpdateRequest
{
    protected function getResource(int $relationId): string
    {
        return "users/$relationId/training-records";
    }
}
