<?php

declare(strict_types=1);

namespace App\Infrastructure\Project;

use App\Domain\Project\ProjectStatus;
use InvalidArgumentException;

final class ProjectStatusCast
{
    public function get($model, string $key, $value, array $attributes): ProjectStatus
    {
        if (ProjectStatus::tryFrom($value) === null) {
            throw new InvalidArgumentException("Cannot fetch a ProjectStatus value from \"{$value}\"");
        }

        return ProjectStatus::from($value);
    }

    public function set($model, string $key, $value, array $attributes): int
    {
        if (!$value instanceof ProjectStatus) {
            throw new InvalidArgumentException("The given value \"{$value}\" is not a ProjectStatus");
        }

        return $value->value;
    }
}
