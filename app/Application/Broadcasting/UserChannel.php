<?php

namespace App\Application\Broadcasting;

use App\Domain\User\User;

class UserChannel
{
    public function join(User $authUser, User $user): bool
    {
        return $authUser->id === $user->id;
    }
}
