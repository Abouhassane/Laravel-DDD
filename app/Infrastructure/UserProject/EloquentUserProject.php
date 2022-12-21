<?php

declare(strict_types=1);

namespace App\Infrastructure\UserProject;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $user_id
 * @property int $project_id
 */
class EloquentUserProject extends Pivot
{
    protected $table = 'users_projects';
}
