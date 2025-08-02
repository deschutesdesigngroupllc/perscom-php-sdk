<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Resources\Forms\FieldResource;
use Perscom\Http\Resources\Forms\SubmissionResource;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasSearchEndpoints;

class FormResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'forms';
    }

    public function fields(int $formId): FieldResource
    {
        return new FieldResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$formId/fields",
        );
    }

    public function submissions(int $formId): SubmissionResource
    {
        return new SubmissionResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$formId/submissions",
        );
    }
}
