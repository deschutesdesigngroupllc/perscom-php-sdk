<?php

declare(strict_types=1);

namespace Perscom\Data;

use Illuminate\Contracts\Support\Arrayable;
use Override;

/**
 * @implements Arrayable<string, mixed>
 */
final class ScopeObject implements Arrayable
{
    /**
     * @param  string  $name  The name of the scope to use.
     * @param  array<string, mixed>  $parameters  Parameters if required by the scope to operate.
     */
    public function __construct(
        public string $name,
        public array $parameters = []
    ) {
        //
    }

    /**
     * @return array<string, mixed>
     */
    #[Override]
    public function toArray(): array
    {
        $body = [
            'name' => $this->name,
        ];

        if (filled($this->parameters)) {
            $body['parameters'] = $this->parameters;
        }

        return $body;
    }
}
