<?php

declare(strict_types=1);

namespace Perscom\Http\Resources\Users;

use Perscom\Contracts\Attachable;
use Perscom\Contracts\Crudable;
use Perscom\Http\Resources\Resource;
use Perscom\Traits\HasAttachEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Saloon\Http\Connector;

class StatusResource extends Resource implements Attachable, Crudable
{
    use HasAttachEndpoints;
    use HasCrudEndpoints;

    public function __construct(protected Connector $connector, protected string $resource)
    {
        parent::__construct($connector);
    }

    public function getResource(): string
    {
        return $this->resource;
    }
}
