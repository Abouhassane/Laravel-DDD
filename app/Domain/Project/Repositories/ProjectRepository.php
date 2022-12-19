<?php

namespace App\Domain\Project\Repositories;

use App\Domain\User\User;
use Illuminate\Support\Collection;

interface ProjectRepository
{
    public function getAllUserProjectsWithTrashedOnes(User $user): Collection;
}
