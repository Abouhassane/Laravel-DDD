<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use App\Domain\Project\Project;
use App\Domain\UserProject\UserProject;
use Database\Factories\UserFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * @method static UserFactory factory(callable|array|int|null $count = null, callable|array $state = [])
 *
 * @property int                    $id
 * @property string                 $name
 * @property string                 $email
 * @property DateTimeInterface|null $email_verified_at
 * @property string                 $password
 * @property string|null            $remember_token
 * @property DateTimeInterface|null $deleted_at
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 *
 * Eloquent relations
 * @property Collection|Project[]   $projects
 */
class EloquentUser extends Model
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'users_projects',
            'user_id',
            'project_id',
        )->using(UserProject::class);
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
