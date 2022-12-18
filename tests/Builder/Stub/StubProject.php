<?php

declare(strict_types=1);

namespace Tests\Builder\Stub;

use App\Domain\Project\Project;

final class StubProject extends Project
{
    public function delete(): bool
    {
        $this->attributes['deleted_at'] = now();

        return true;
    }

    public function fresh($with = []): self
    {
        return $this;
    }
}
