<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Events;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Resources\Resource;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Http\Connector;

class ImageResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasSearchEndpoints;

    public function __construct(Connector $connector, protected string $resource)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return $this->resource;
    }
}
