<?php

namespace Database\Seeders\Testing;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(2)->create();

        User::factory()->unverified()->create();
    }
}
