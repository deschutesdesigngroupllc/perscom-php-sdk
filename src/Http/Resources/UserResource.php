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

    public function profilePhoto(int $userId): ProfilePhotoResource
    {
        return new ProfilePhotoResource($this->connector, $userId);
    }

    public function coverPhoto(int $userId): CoverPhotoResource
    {
        return new CoverPhotoResource($this->connector, $userId);
    }

    public function attachments(int $userId): AttachmentsResource
    {
        return new AttachmentsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/attachments"
        );
    }

    public function assignmentRecords(int $userId): AssignmentRecordsResource
    {
        return new AssignmentRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/assignment-records"
        );
    }

    public function awardRecords(int $userId): AwardRecordsResource
    {
        return new AwardRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/award-records"
        );
    }

    public function combatRecords(int $userId): CombatRecordsResource
    {
        return new CombatRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/combat-records"
        );
    }

    public function qualificationRecords(int $userId): QualificationRecordsResource
    {
        return new QualificationRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/qualification-records"
        );
    }

    public function rankRecords(int $userId): RankRecordsResource
    {
        return new RankRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/rank-records"
        );
    }

    public function serviceRecords(int $userId): ServiceRecordsResource
    {
        return new ServiceRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/service-records"
        );
    }

    public function trainingRecords(int $userId): TrainingRecordsResource
    {
        return new TrainingRecordsResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/training-records"
        );
    }

    public function statuses(int $userId): StatusResource
    {
        return new StatusResource(
            connector: $this->connector,
            resource: "{$this->getResource()}/$userId/status-records"
        );
    }
}
