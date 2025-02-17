<?php

declare(strict_types=1);

namespace Perscom\Http\Requests\Roster;

use Illuminate\Support\Arr;
use Perscom\Enums\RosterType;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetRosterGroupRequest extends Request
{
    protected Method $method = Method::GET;

    /**
     * @param  string|array<string>  $include
     */
    public function __construct(
        public int $id,
        public string|array $include = [],
        public RosterType $type = RosterType::Automatic
    ) {
        $this->include = Arr::wrap($this->include);
    }

    public function resolveEndpoint(): string
    {
        return "roster/$this->id";
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultQuery(): array
    {
        $query = [
            'type' => $this->type->value,
        ];

        if (filled($this->include)) {
            $query['include'] = implode(',', $this->include);
        }

        return $query;
    }
}
