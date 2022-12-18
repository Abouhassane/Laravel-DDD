<?php

declare(strict_types=1);

namespace Builder\Stub;

use App\Models\User;

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
