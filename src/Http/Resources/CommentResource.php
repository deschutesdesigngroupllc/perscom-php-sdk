<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\Comments\CreateCommentRequest;
use Perscom\Http\Requests\Comments\DeleteCommentRequest;
use Perscom\Http\Requests\Comments\GetCommentRequest;
use Perscom\Http\Requests\Comments\GetCommentsRequest;
use Perscom\Http\Requests\Comments\UpdateCommentRequest;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class CommentResource extends Resource implements ResourceContract, Searchable
{
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'comments';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetCommentsRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetCommentRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateCommentRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateCommentRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteCommentRequest($id));
    }
}
