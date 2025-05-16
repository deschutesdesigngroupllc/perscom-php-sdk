<?php

declare(strict_types=1);

namespace Perscom;

use JsonException;
use Perscom\Enums\RosterType;
use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\ForbiddenException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\PaymentRequiredException;
use Perscom\Exceptions\RateLimitException;
use Perscom\Exceptions\ServerErrorException;
use Perscom\Exceptions\ServiceUnavailableException;
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
use Perscom\Http\Resources\CompetencyResource;
use Perscom\Http\Resources\CredentialResource;
use Perscom\Http\Resources\DocumentResource;
use Perscom\Http\Resources\EventResource;
use Perscom\Http\Resources\FormResource;
use Perscom\Http\Resources\GroupResource;
use Perscom\Http\Resources\HealthResource;
use Perscom\Http\Resources\ImageResource;
use Perscom\Http\Resources\IssuerResource;
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
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class PerscomConnection extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use HasLogging;

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

    public function competencies(): CompetencyResource
    {
        return new CompetencyResource($this);
    }

    public function credentials(): CredentialResource
    {
        return new CredentialResource($this);
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

    public function issuers(): IssuerResource
    {
        return new IssuerResource($this);
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

    /**
     * @throws JsonException
     */
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        return match ($response->status()) {
            401 => new AuthenticationException(
                message: $response->json('error.message') ?? 'You are not authenticated. Please provide a valid API key that contains your PERSCOM ID to continue.',
            ),
            402 => new PaymentRequiredException(
                message: $response->json('error.message') ?? 'A valid subscription is required to complete this request.',
            ),
            403 => new ForbiddenException(
                message: $response->json('error.message') ?? 'he API key provided does not have the correct permissions and/or scopes to perform the requested action.',
            ),
            404 => new NotFoundHttpException(
                message: $response->json('error.message') ?? 'The requested resource or endpoint could not be found.',
            ),
            429 => new RateLimitException(
                message: $response->json('error.message') ?? 'You have exceeded the API rate limit. Please wait a minute before trying again.',
            ),
            500 => new ServerErrorException(
                message: $response->json('error.message') ?? 'There was a server error with your last request. Please try again.',
            ),
            503 => new ServiceUnavailableException(
                message: $response->json('error.message') ?? 'The API is currently down for maintenance. Please check back later.',
            ),
            default => parent::getRequestException($response, $senderException)
        };
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
}
