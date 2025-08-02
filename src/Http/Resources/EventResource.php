<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Resources\Events\ImageResource;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasImageEndpoints;
use Perscom\Traits\HasSearchEndpoints;

class EventResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasImageEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'events';
    }

    public function images(int $eventId): ImageResource
    {
        return new ImageResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$eventId/image",
        );
    }
}
