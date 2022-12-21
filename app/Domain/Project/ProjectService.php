<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Project\Repositories\ProjectRepository;
use App\Domain\User\User;
use Illuminate\Support\Collection;

class ProjectService
{
    private ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAllUserProjectsGroupedByStatus(User $user): Collection
    {
        return $this->projectRepository
            ->getAllUserProjectsWithTrashedOnes($user)
            ->groupBy(fn(Project $project) => $project->status->value);
    }
}
