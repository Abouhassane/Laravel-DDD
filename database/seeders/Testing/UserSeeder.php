<?php

declare(strict_types=1);

namespace Database\Seeders\Testing;

use App\Domain\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(2)->create();

        User::factory()->unverified()->create();
    }
}
