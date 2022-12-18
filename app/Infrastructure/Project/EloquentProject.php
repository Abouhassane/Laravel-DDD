<?php

declare(strict_types=1);

namespace App\Infrastructure\Project;

use App\Domain\Project\ProjectStatus;
use App\Domain\User\User;
use App\Domain\UserProject\UserProject;
use Database\Factories\ProjectFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * @property int                    $id
 * @property string                 $title
 * @property ProjectStatus          $status
 * @property float                  $funds
 * @property DateTimeInterface|null $started_at
 * @property DateTimeInterface|null $blocked_at
 * @property DateTimeInterface|null $terminated_at
 * @property DateTimeInterface|null $deleted_at
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 *
 * Eloquent relations
 * @property Collection|User[]      $users
 */
class EloquentProject extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $attributes = [
        'status' => ProjectStatus::GENERATED,
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'status',
        'funds',
        'started_at',
        'blocked_at',
        'terminated_at',
    ];

    protected $dates = [
        'started_at',
        'blocked_at',
        'terminated_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'status' => ProjectStatusCast::class,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_projects',
            'project_id',
            'user_id',
        )->using(UserProject::class);
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
