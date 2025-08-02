<?php

declare(strict_types=1);

namespace Perscom\Http\Resources;

use Perscom\Contracts\Batchable;
use Perscom\Contracts\Crudable;
use Perscom\Contracts\Searchable;
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
use Perscom\Traits\HasCrudEndpoints;
use Perscom\Traits\HasSearchEndpoints;

class UserResource extends Resource implements Batchable, Crudable, Searchable
{
    use HasBatchEndpoints;
    use HasCrudEndpoints;
    use HasSearchEndpoints;

    public function getResource(): string
    {
        return 'users';
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
        return new AttachmentsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/attachments"
        );
    }

    public function assignment_records(int $id): AssignmentRecordsResource
    {
        return new AssignmentRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/assignment-records"
        );
    }

    public function award_records(int $id): AwardRecordsResource
    {
        return new AwardRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/award-records"
        );
    }

    public function combat_records(int $id): CombatRecordsResource
    {
        return new CombatRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/combat-records"
        );
    }

    public function qualification_records(int $id): QualificationRecordsResource
    {
        return new QualificationRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/qualification-records"
        );
    }

    public function rank_records(int $id): RankRecordsResource
    {
        return new RankRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/rank-records"
        );
    }

    public function service_records(int $id): ServiceRecordsResource
    {
        return new ServiceRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/service-records"
        );
    }

    public function training_records(int $id): TrainingRecordsResource
    {
        return new TrainingRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/training-records"
        );
    }

    public function statuses(int $id): StatusResource
    {
        return new StatusResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$id/status-records"
        );
    }
}
