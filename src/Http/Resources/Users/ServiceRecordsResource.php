<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\Attachable;
use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Resources\Resource;
use Perscom\Traits\HasAttachEndpoints;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Http\Connector;

class ServiceRecordsResource extends Resource implements Attachable, Batchable, Crudable, Searchable
{
    use HasAttachEndpoints;
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasSearchEndpoints;

    public function __construct(protected Connector $connector, protected string $resource)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return $this->resource;
    }
}
