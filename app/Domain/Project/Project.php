<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Infrastructure\Project\EloquentProject;

class Project extends EloquentProject
{
    public const STATUSES = [
        ProjectStatus::GENERATED,
        ProjectStatus::IN_PROGRESS,
        ProjectStatus::BLOCKED,
        ProjectStatus::TERMINATED,
    ];

    public const FINISHED_STATUSES = [
        ProjectStatus::BLOCKED,
        ProjectStatus::TERMINATED,
    ];
}
