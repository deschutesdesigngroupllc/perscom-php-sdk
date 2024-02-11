<?php

namespace Perscom\Http\Resources;

use Perscom\Contracts\ResourceContract;
use Perscom\Data\FilterObject;
use Perscom\Data\SortObject;
use Perscom\Http\Requests\Users\CreateUserRequest;
use Perscom\Http\Requests\Users\DeleteUserRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Perscom\Http\Requests\Users\SearchUsersRequest;
use Perscom\Http\Requests\Users\UpdateUserRequest;
use Perscom\Http\Resources\Users\AssignmentRecordsResource;
use Perscom\Http\Resources\Users\AwardRecordsResource;
use Perscom\Http\Resources\Users\CombatRecordsResource;
use Perscom\Http\Resources\Users\CoverPhotoResource;
use Perscom\Http\Resources\Users\ProfilePhotoResource;
use Perscom\Http\Resources\Users\QualificationRecordsResource;
use Perscom\Http\Resources\Users\RankRecordsResource;
use Perscom\Http\Resources\Users\ServiceRecordsResource;
use Saloon\Contracts\Response;

class UserResource extends Resource implements ResourceContract
{
    /**
     * @param string|array $include
     * @param int $page
     * @param int $limit
     * @return Response
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUsersRequest($include, $page, $limit));
    }

    /**
     * @param string|null $value
     * @param SortObject|array<SortObject>|null $sort
     * @param FilterObject|array<FilterObject>|null $filter
     * @param string|array<string> $include
     * @param int $page
     * @param int $limit
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
        return $this->connector->send(new SearchUsersRequest($value, $sort, $filter, $include, $page, $limit));
    }

    /**
     * @param int $id
     * @param string|array<string> $include
     * @return Response
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetUserRequest($id, $include));
    }

    /**
     * @param array<string, mixed> $data
     * @return Response
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRequest($data));
    }

    /**
     * @param int $id
     * @param array<string, mixed> $data
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

    /**
     * @param int $id
     * @return ProfilePhotoResource
     */
    public function profile_photo(int $id): ProfilePhotoResource
    {
        return new ProfilePhotoResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return CoverPhotoResource
     */
    public function cover_photo(int $id): CoverPhotoResource
    {
        return new CoverPhotoResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return AssignmentRecordsResource
     */
    public function assignment_records(int $id): AssignmentRecordsResource
    {
        return new AssignmentRecordsResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return AwardRecordsResource
     */
    public function award_records(int $id): AwardRecordsResource
    {
        return new AwardRecordsResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return CombatRecordsResource
     */
    public function combat_records(int $id): CombatRecordsResource
    {
        return new CombatRecordsResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return QualificationRecordsResource
     */
    public function qualification_records(int $id): QualificationRecordsResource
    {
        return new QualificationRecordsResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return RankRecordsResource
     */
    public function rank_records(int $id): RankRecordsResource
    {
        return new RankRecordsResource($this->connector, $id);
    }

    /**
     * @param int $id
     * @return ServiceRecordsResource
     */
    public function service_records(int $id): ServiceRecordsResource
    {
        return new ServiceRecordsResource($this->connector, $id);
    }
}
