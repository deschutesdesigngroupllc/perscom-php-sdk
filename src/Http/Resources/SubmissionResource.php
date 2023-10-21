<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Submissions\CreateSubmissionRequest;
use Perscom\Http\Requests\Submissions\DeleteSubmissionRequest;
use Perscom\Http\Requests\Submissions\GetSubmissionRequest;
use Perscom\Http\Requests\Submissions\GetSubmissionsRequest;
use Perscom\Http\Requests\Submissions\SearchSubmissionsRequest;
use Perscom\Http\Requests\Submissions\UpdateSubmissionRequest;
use Saloon\Contracts\Response;

class SubmissionResource extends Resource implements ResourceContract
{
    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetSubmissionsRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchSubmissionsRequest($data));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetSubmissionRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateSubmissionRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateSubmissionRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteSubmissionRequest($id));
    }
}
