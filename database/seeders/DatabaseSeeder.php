<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\Project\Project;
use App\Domain\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // $this->call([]);
        $user1 = User::factory()
            ->has(Project::factory()->progressing())
            ->has(Project::factory()->progressing()->deleted())
            ->has(Project::factory()->blocked())
            ->has(Project::factory()->terminated())
            ->create();

        $user2 = User::factory()->create();
        $user2->projects()->sync(
            $user1->projects->pluck('id')
        );
    }
}
