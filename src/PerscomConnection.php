<?php

declare(strict_types=1);

namespace Perscom;

use Perscom\Enums\RosterType;
use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\TenantCouldNotBeIdentifiedException;
use Perscom\Http\Resources\AnnouncementResource;
use Perscom\Http\Resources\AssignmentRecordsResource;
use Perscom\Http\Resources\AttachmentResource;
use Perscom\Http\Resources\AwardRecordsResource;
use Perscom\Http\Resources\AwardResource;
use Perscom\Http\Resources\CacheResource;
use Perscom\Http\Resources\CalendarResource;
use Perscom\Http\Resources\CategoriesResource;
use Perscom\Http\Resources\CombatRecordsResource;
use Perscom\Http\Resources\CommentResource;
use Perscom\Http\Resources\DocumentResource;
use Perscom\Http\Resources\EventResource;
use Perscom\Http\Resources\FormResource;
use Perscom\Http\Resources\GroupResource;
use Perscom\Http\Resources\HealthResource;
use Perscom\Http\Resources\ImageResource;
use Perscom\Http\Resources\MessageResource;
use Perscom\Http\Resources\NewsfeedResource;
use Perscom\Http\Resources\PositionResource;
use Perscom\Http\Resources\QualificationRecordsResource;
use Perscom\Http\Resources\QualificationResource;
use Perscom\Http\Resources\RankRecordsResource;
use Perscom\Http\Resources\RankResource;
use Perscom\Http\Resources\RosterResource;
use Perscom\Http\Resources\ServiceRecordsResource;
use Perscom\Http\Resources\SettingsResource;
use Perscom\Http\Resources\SpecialtyResource;
use Perscom\Http\Resources\StatusResource;
use Perscom\Http\Resources\SubmissionResource;
use Perscom\Http\Resources\TaskResource;
use Perscom\Http\Resources\TrainingRecordsResource;
use Perscom\Http\Resources\UnitResource;
use Perscom\Http\Resources\UserResource;
use Perscom\Support\Composer;
use Perscom\Traits\HasLogging;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class PerscomConnection extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use HasLogging;
    use HasRateLimits;

    public static string $apiUrl = 'https://api.perscom.io/v2';

    public function __construct(
        protected string $apiKey,
        protected ?string $perscomId = null,
        protected ?string $baseUrl = null) {}

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl ?? static::$apiUrl;
    }

    public function announcements(): AnnouncementResource
    {
        return new AnnouncementResource($this);
    }

    public function assignmentRecords(): AssignmentRecordsResource
    {
        return new AssignmentRecordsResource($this);
    }

    public function attachments(): AttachmentResource
    {
        return new AttachmentResource($this);
    }

    public function awardRecords(): AwardRecordsResource
    {
        return new AwardRecordsResource($this);
    }

    public function awards(): AwardResource
    {
        return new AwardResource($this);
    }

    public function calendars(): CalendarResource
    {
        return new CalendarResource($this);
    }

    public function categories(): CategoriesResource
    {
        return new CategoriesResource($this);
    }

    public function cache(): CacheResource
    {
        return new CacheResource($this);
    }

    public function combatRecords(): CombatRecordsResource
    {
        return new CombatRecordsResource($this);
    }

    public function comments(): CommentResource
    {
        return new CommentResource($this);
    }

    public function documents(): DocumentResource
    {
        return new DocumentResource($this);
    }

    public function events(): EventResource
    {
        return new EventResource($this);
    }

    public function forms(): FormResource
    {
        return new FormResource($this);
    }

    public function groups(): GroupResource
    {
        return new GroupResource($this);
    }

    public function health(): HealthResource
    {
        return new HealthResource($this);
    }

    public function images(): ImageResource
    {
        return new ImageResource($this);
    }

    public function messages(): MessageResource
    {
        return new MessageResource($this);
    }

    public function newsfeed(): NewsfeedResource
    {
        return new NewsfeedResource($this);
    }

    public function positions(): PositionResource
    {
        return new PositionResource($this);
    }

    public function qualificationRecords(): QualificationRecordsResource
    {
        return new QualificationRecordsResource($this);
    }

    public function qualifications(): QualificationResource
    {
        return new QualificationResource($this);
    }

    public function rankRecords(): RankRecordsResource
    {
        return new RankRecordsResource($this);
    }

    public function ranks(): RankResource
    {
        return new RankResource($this);
    }

    public function roster(RosterType $type = RosterType::Automatic): RosterResource
    {
        $roster = new RosterResource($this);

        return $roster->setType($type);
    }

    public function serviceRecords(): ServiceRecordsResource
    {
        return new ServiceRecordsResource($this);
    }

    public function trainingRecords(): TrainingRecordsResource
    {
        return new TrainingRecordsResource($this);
    }

    public function settings(): SettingsResource
    {
        return new SettingsResource($this);
    }

    public function specialties(): SpecialtyResource
    {
        return new SpecialtyResource($this);
    }

    public function statuses(): StatusResource
    {
        return new StatusResource($this);
    }

    public function submissions(): SubmissionResource
    {
        return new SubmissionResource($this);
    }

    public function tasks(): TaskResource
    {
        return new TaskResource($this);
    }

    public function units(): UnitResource
    {
        return new UnitResource($this);
    }

    public function users(): UserResource
    {
        return new UserResource($this);
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        if ($response->json('error.type') === 'TenantCouldNotBeIdentified') {
            return new TenantCouldNotBeIdentifiedException;
        }

        if ($response->json('error.type') === 'AuthenticationException') {
            return new AuthenticationException;
        }

        if ($response->json('error.type') === 'NotFoundHttpException') {
            return new NotFoundHttpException;
        }

        return parent::getRequestException($response, $senderException);
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->apiKey);
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultHeaders(): array
    {
        $headers = [
            'X-Perscom-Sdk' => true,
        ];

        if (! is_null($this->perscomId)) {
            $headers['X-Perscom-Id'] = $this->perscomId;
        }

        if ($version = Composer::getPerscomPackageVersion()) {
            $headers['X-Perscom-Sdk-Version'] = $version;
        }

        return $headers;
    }

    /**
     * @return array<Limit>
     */
    protected function resolveLimits(): array
    {
        return [
            Limit::allow(1000)->everyMinute(),
        ];
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new MemoryStore;
    }
}
