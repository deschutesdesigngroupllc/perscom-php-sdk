<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\Events\CreateEventRequest;
use Perscom\Http\Requests\Events\DeleteEventRequest;
use Perscom\Http\Requests\Events\GetEventRequest;
use Perscom\Http\Requests\Events\GetEventsRequest;
use Perscom\Http\Requests\Events\UpdateEventRequest;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasImageEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class EventResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasImageEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'events';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetEventsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetEventRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateEventRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateEventRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteEventRequest($id));
    }
}
