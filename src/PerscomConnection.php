<?php

namespace Perscom;

use Perscom\Exceptions\AuthenticationException;
use Perscom\Exceptions\NotFoundHttpException;
use Perscom\Exceptions\TenantCouldNotBeIdentifiedException;
use Perscom\Http\Resources\AnnouncementResource;
use Perscom\Http\Resources\AwardResource;
use Perscom\Http\Resources\CalendarResource;
use Perscom\Http\Resources\EventResource;
use Perscom\Http\Resources\FormResource;
use Perscom\Http\Resources\GroupResource;
use Perscom\Http\Resources\PositionResource;
use Perscom\Http\Resources\QualificationResource;
use Perscom\Http\Resources\RankResource;
use Perscom\Http\Resources\SpecialtyResource;
use Perscom\Http\Resources\StatusResource;
use Perscom\Http\Resources\SubmissionResource;
use Perscom\Http\Resources\TaskResource;
use Perscom\Http\Resources\UnitResource;
use Perscom\Http\Resources\UserResource;
use Perscom\Support\Composer;
use Perscom\Traits\HasLogging;
use Saloon\Contracts\Response;
use Saloon\Http\Connector;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Stores\MemoryStore;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class PerscomConnection extends Connector
{
    use AlwaysThrowOnErrors;
    use AcceptsJson;
    use HasLogging;
    use HasRateLimits;

    /**
     * @param string $apiKey
     * @param string $perscomId
     * @param string|null $baseUrl
     */
    public function __construct(protected string $apiKey, protected string $perscomId, protected ?string $baseUrl = null)
    {
        $this->withTokenAuth($this->apiKey);
    }

    /**
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl ?? 'https://api.perscom.io/v1';
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultHeaders(): array
    {
        $headers = [
            'X-Perscom-Sdk' => true,
            'X-Perscom-Id' => $this->perscomId
        ];

        if ($version = Composer::getPerscomPackageVersion()) {
            $headers['X-Perscom-Sdk-Version'] = $version;
        }

        return $headers;
    }

    /**
     * @return AnnouncementResource
     */
    public function announcements(): AnnouncementResource
    {
        return new AnnouncementResource($this);
    }

    /**
     * @return AwardResource
     */
    public function awards(): AwardResource
    {
        return new AwardResource($this);
    }

    /**
     * @return CalendarResource
     */
    public function calendars(): CalendarResource
    {
        return new CalendarResource($this);
    }

    /**
     * @return EventResource
     */
    public function events(): EventResource
    {
        return new EventResource($this);
    }

    /**
     * @return FormResource
     */
    public function forms(): FormResource
    {
        return new FormResource($this);
    }

    /**
     * @return GroupResource
     */
    public function groups(): GroupResource
    {
        return new GroupResource($this);
    }

    /**
     * @return PositionResource
     */
    public function positions(): PositionResource
    {
        return new PositionResource($this);
    }

    /**
     * @return QualificationResource
     */
    public function qualifications(): QualificationResource
    {
        return new QualificationResource($this);
    }

    /**
     * @return RankResource
     */
    public function ranks(): RankResource
    {
        return new RankResource($this);
    }

    /**
     * @return SpecialtyResource
     */
    public function specialties(): SpecialtyResource
    {
        return new SpecialtyResource($this);
    }

    /**
     * @return StatusResource
     */
    public function statuses(): StatusResource
    {
        return new StatusResource($this);
    }

    /**
     * @return SubmissionResource
     */
    public function submissions(): SubmissionResource
    {
        return new SubmissionResource($this);
    }

    /**
     * @return TaskResource
     */
    public function tasks(): TaskResource
    {
        return new TaskResource($this);
    }

    /**
     * @return UnitResource
     */
    public function units(): UnitResource
    {
        return new UnitResource($this);
    }

    /**
     * @return UserResource
     */
    public function users(): UserResource
    {
        return new UserResource($this);
    }

    /**
     * @return array<Limit>
     */
    protected function resolveLimits(): array
    {
        return [
            Limit::allow(60)->everyMinute(),
        ];
    }

    /**
     * @return RateLimitStore
     */
    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new MemoryStore();
    }

    /**
     * @param Response $response
     * @param Throwable|null $senderException
     * @return Throwable|null
     */
    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        if ($response->json('error.type') === 'TenantCouldNotBeIdentified') {
            return new TenantCouldNotBeIdentifiedException();
        }

        if ($response->json('error.type') === 'AuthenticationException') {
            return new AuthenticationException();
        }

        if ($response->json('error.type') === 'NotFoundHttpException') {
            return new NotFoundHttpException();
        }

        return parent::getRequestException($response, $senderException);
    }
}
