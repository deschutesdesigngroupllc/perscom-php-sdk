<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Qualifications\CreateQualificationRequest;
use Perscom\Http\Requests\Qualifications\DeleteQualificationRequest;
use Perscom\Http\Requests\Qualifications\GetQualificationRequest;
use Perscom\Http\Requests\Qualifications\GetQualificationsRequest;
use Perscom\Http\Requests\Qualifications\SearchQualificationsRequest;
use Perscom\Http\Requests\Qualifications\UpdateQualificationRequest;
use Saloon\Contracts\Response;

class QualificationResource extends Resource implements ResourceContract
{
    /**
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetQualificationsRequest($page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function search(array $data): Response
    {
        return $this->connector->send(new SearchQualificationsRequest($data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function get(int $id): Response
    {
        return $this->connector->send(new GetQualificationRequest($id));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateQualificationRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateQualificationRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteQualificationRequest($id));
    }
}
