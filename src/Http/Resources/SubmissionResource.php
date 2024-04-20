<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Submissions\CreateSubmissionRequest;
use Perscom\Http\Requests\Submissions\DeleteSubmissionRequest;
use Perscom\Http\Requests\Submissions\GetSubmissionRequest;
use Perscom\Http\Requests\Submissions\GetSubmissionsRequest;
use Perscom\Http\Requests\Submissions\SearchSubmissionsRequest;
use Perscom\Http\Requests\Submissions\UpdateSubmissionRequest;
use Perscom\Http\Resources\Submissions\StatusResource;
use Saloon\Contracts\Response;

class SubmissionResource extends Resource implements ResourceContract
{
    /**
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetSubmissionsRequest($include, $page, $limit));
    }

    /**
     * @param  string|null  $value
     * @param  SortObject|array<SortObject>|null  $sort
     * @param  FilterObject|array<FilterObject>|null  $filter
     * @param  string|array<string>  $include
     * @param  int  $page
     * @param  int  $limit
     * @return Response
     */
    public function search(
        ?string $value = null,
        mixed $sort = null,
        mixed $filter = null,
        string|array $include = [],
        int $page = 1,
        int $limit = 20,
    ): Response {
        return $this->connector->send(new SearchSubmissionsRequest($value, $sort, $filter, $include, $page, $limit));
    }

    /**
     * @param  int  $id
     * @param  string|array<string>  $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetSubmissionRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateSubmissionRequest($data));
    }

    /**
     * @param  int  $id
     * @param  array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateSubmissionRequest($id, $data));
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteSubmissionRequest($id));
    }

    /**
     * @param  int  $id
     * @return StatusResource
     */
    public function statuses(int $id): StatusResource
    {
        return new StatusResource($this->connector, $id);
    }
}
