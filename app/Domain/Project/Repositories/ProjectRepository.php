<?php

declare(strict_types=1);

namespace App\Domain\Project\Repositories;

use App\Domain\User\User;
use Illuminate\Support\Collection;

interface ProjectRepository
{
    public function getAllUserProjectsWithTrashedOnes(User $user): Collection;
}
