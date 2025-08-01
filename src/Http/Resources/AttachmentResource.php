<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\Attachments\CreateAttachmentRequest;
use Perscom\Http\Requests\Attachments\DeleteAttachmentRequest;
use Perscom\Http\Requests\Attachments\GetAttachmentRequest;
use Perscom\Http\Requests\Attachments\GetAttachmentsRequest;
use Perscom\Http\Requests\Attachments\UpdateAttachmentRequest;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class AttachmentResource extends Resource implements ResourceContract, Searchable
{
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'attachments';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetAttachmentsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetAttachmentRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateAttachmentRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateAttachmentRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteAttachmentRequest($id));
    }
}
