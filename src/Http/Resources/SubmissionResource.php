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
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetSubmissionsRequest($page, $limit));
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
     * @return Response
     */
    public function get(int $id): Response
    {
        return $this->connector->send(new GetSubmissionRequest($id));
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
