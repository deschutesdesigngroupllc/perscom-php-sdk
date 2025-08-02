<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
use Perscom\Http\Requests\Users\CreateUserRequest;
use Perscom\Http\Requests\Users\DeleteUserRequest;
use Perscom\Http\Requests\Users\GetUserRequest;
use Perscom\Http\Requests\Users\GetUsersRequest;
use Perscom\Http\Requests\Users\UpdateUserRequest;
use Perscom\Http\Resources\Users\AssignmentRecordsResource;
use Perscom\Http\Resources\Users\AttachmentsResource;
use Perscom\Http\Resources\Users\AwardRecordsResource;
use Perscom\Http\Resources\Users\CombatRecordsResource;
use Perscom\Http\Resources\Users\CoverPhotoResource;
use Perscom\Http\Resources\Users\ProfilePhotoResource;
use Perscom\Http\Resources\Users\QualificationRecordsResource;
use Perscom\Http\Resources\Users\RankRecordsResource;
use Perscom\Http\Resources\Users\ServiceRecordsResource;
use Perscom\Http\Resources\Users\StatusResource;
use Perscom\Http\Resources\Users\TrainingRecordsResource;
use Perscom\Traits\HasBatchEndpoints;
use Perscom\Traits\HasSearchEndpoints;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class UserResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'users';
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function all(string|array $include = [], int $page = 1, int $limit = 20): Response
    {
        return $this->connector->send(new GetUsersRequest($include, $page, $limit));
    }

    /**
     * @param  string|array<string>  $include
     *
     * @throws FatalRequestException|RequestException
     */
    public function get(int $id, string|array $include = []): Response
    {
        return $this->connector->send(new GetUserRequest($id, $include));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function create(array $data): Response
    {
        return $this->connector->send(new CreateUserRequest($data));
    }

    /**
     * @param  array<string, mixed>  $data
     *
     * @throws FatalRequestException|RequestException
     */
    public function update(int $id, array $data): Response
    {
        return $this->connector->send(new UpdateUserRequest($id, $data));
    }

    /**
     * @throws FatalRequestException|RequestException
     */
    public function delete(int $id): Response
    {
        return $this->connector->send(new DeleteUserRequest($id));
    }

    public function profile_photo(int $id): ProfilePhotoResource
    {
        return new ProfilePhotoResource($this->connector, $id);
    }

    public function cover_photo(int $id): CoverPhotoResource
    {
        return new CoverPhotoResource($this->connector, $id);
    }

    public function attachments(int $id): AttachmentsResource
    {
        return new AttachmentsResource($this->connector, $id);
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

    public function training_records(int $id): TrainingRecordsResource
    {
        return new TrainingRecordsResource($this->connector, $id);
    }

    public function statuses(int $id): StatusResource
    {
        return new StatusResource($this->connector, $id);
    }
}
