<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\BusinessEntity;
use App\Infrastructure\User\EloquentUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends EloquentUser implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    BusinessEntity
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
}
