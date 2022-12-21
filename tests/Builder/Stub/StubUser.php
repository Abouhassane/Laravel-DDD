<?php

declare(strict_types=1);

namespace Tests\Builder\Stub;

use App\Domain\User\User;

final class StubUser extends User
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
