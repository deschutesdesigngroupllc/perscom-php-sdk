<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Resources\Groups\UnitsResource;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasImageEndpoints;
use Perscom\Traits\HasSearchEndpoints;

class GroupResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasImageEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'groups';
    }

    public function units(int $groupId): UnitsResource
    {
        return new UnitsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$groupId/units",
        );
    }
}
