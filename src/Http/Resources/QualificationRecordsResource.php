<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasSearchEndpoints;

class QualificationRecordsResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'qualification-records';
    }
}
