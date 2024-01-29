<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Http\Requests\Users\CreateUserRequest;
use Perscom\Http\Requests\Users\DeleteUserRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Perscom\Http\Requests\Users\SearchUsersRequest;
use Perscom\Http\Requests\Users\UpdateUserRequest;
use Perscom\Http\Resources\Users\AssignmentRecordsResource;
use Perscom\Http\Resources\Users\AwardRecordsResource;
use Perscom\Http\Resources\Users\CombatRecordsResource;
use Perscom\Http\Resources\Users\QualificationRecordsResource;
use Perscom\Http\Resources\Users\RankRecordsResource;
use Perscom\Http\Resources\Users\ServiceRecordsResource;
use Saloon\Contracts\Response;

class UserResource extends Resource implements ResourceContract
{
    /**
     * @param array<string> $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUsersRequest($include, $page, $limit));
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string> $include
     * @return Response
     */
    public function search(array $data, array $include = []): Response
    {
        return $this->connector->send(new SearchUsersRequest($data, $include));
    }

    /**
     * @param int $id
     * @param array<string> $include
     * @return Response
     */
    public function get(int $id, array $include = []): Response
    {
        return $this->connector->send(new GetUserRequest($id, $include));
    }

    /**
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed>  $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserRequest($id, $data));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserRequest($id));
    }

    public function assignment_records(int $id): AssignmentRecordsResource
    {
        return new AssignmentRecordsResource($this->connector, $id);
    }

    public function award_records(int $id): AwardRecordsResource
    {
        return new AwardRecordsResource($this->connector, $id);
    }

    public function combat_records(int $id): CombatRecordsResource
    {
        return new CombatRecordsResource($this->connector, $id);
    }

    public function qualification_records(int $id): QualificationRecordsResource
    {
        return new QualificationRecordsResource($this->connector, $id);
    }

    public function rank_records(int $id): RankRecordsResource
    {
        return new RankRecordsResource($this->connector, $id);
    }

    public function service_records(int $id): ServiceRecordsResource
    {
        return new ServiceRecordsResource($this->connector, $id);
    }
}
