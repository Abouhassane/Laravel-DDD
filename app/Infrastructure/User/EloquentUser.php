<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use App\Infrastructure\EloquentBusinessEntity;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property int                    $id
 * @property string                 $name
 * @property string                 $email
 * @property DateTimeInterface|null $email_verified_at
 * @property string                 $password
 * @property string|null            $remember_token
 * @property DateTimeInterface|null $created_at
 * @property DateTimeInterface|null $updated_at
 *
 * Eloquent relations
 */
class EloquentUser extends EloquentBusinessEntity
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use SoftDeletes;

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
}
