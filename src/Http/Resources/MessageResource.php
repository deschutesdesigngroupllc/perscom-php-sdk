<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\Messages\CreateMessageRequest;
use Perscom\Http\Requests\Messages\DeleteMessageRequest;
use Perscom\Http\Requests\Messages\GetMessageRequest;
use Perscom\Http\Requests\Messages\GetMessagesRequest;
use Perscom\Http\Requests\Messages\UpdateMessageRequest;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class MessageResource extends Resource implements ResourceContract, Searchable
{
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'messages';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetMessagesRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetMessageRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateMessageRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateMessageRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteMessageRequest($id));
    }
}
