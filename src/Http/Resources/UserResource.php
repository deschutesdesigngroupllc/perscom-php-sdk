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
            resource: sprintf('%s/%d/attachments', $this->getResource(), $userId)
        );
    }

    public function assignmentRecords(int $userId): AssignmentRecordsResource
    {
        return new AssignmentRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/assignment-records', $this->getResource(), $userId)
        );
    }

    public function awardRecords(int $userId): AwardRecordsResource
    {
        return new AwardRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/award-records', $this->getResource(), $userId)
        );
    }

    public function combatRecords(int $userId): CombatRecordsResource
    {
        return new CombatRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/combat-records', $this->getResource(), $userId)
        );
    }

    public function qualificationRecords(int $userId): QualificationRecordsResource
    {
        return new QualificationRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/qualification-records', $this->getResource(), $userId)
        );
    }

    public function rankRecords(int $userId): RankRecordsResource
    {
        return new RankRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/rank-records', $this->getResource(), $userId)
        );
    }

    public function serviceRecords(int $userId): ServiceRecordsResource
    {
        return new ServiceRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/service-records', $this->getResource(), $userId)
        );
    }

    public function trainingRecords(int $userId): TrainingRecordsResource
    {
        return new TrainingRecordsResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/training-records', $this->getResource(), $userId)
        );
    }

    public function statuses(int $userId): StatusResource
    {
        return new StatusResource(
            connector: $this->connector,
            resource: sprintf('%s/%d/status-records', $this->getResource(), $userId)
        );
    }
}
