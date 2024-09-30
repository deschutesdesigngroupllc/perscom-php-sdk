<?php

declare(strict_types=1);

namespace Perscom\Data;

use Illuminate\Contracts\Support\Arrayable;

final class ScopeObject implements Arrayable
{
    /**
     * @param  string  $name  The name of the scope to use.
     * @param  array  $parameters  Parameters if required by the scope to operate.
     */
    public function __construct(
        public string $name,
        public array $parameters = []
    ) {
        //
    }

    /**
     * @return array<string, string>
     */
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
