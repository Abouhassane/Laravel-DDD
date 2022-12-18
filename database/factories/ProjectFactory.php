<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Project\Project;
use App\Domain\Project\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'status' => ProjectStatus::GENERATED,
            'funds' => 15678.256,
            'started_at' => null,
            'blocked_at' => null,
            'terminated_at' => null,
        ];
    }

    public function progressing(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => ProjectStatus::IN_PROGRESS,
            'started_at' => now(),
        ]);
    }

    public function blocked(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => ProjectStatus::BLOCKED,
            'blocked_at' => now(),
        ]);
    }

    public function terminated(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => ProjectStatus::TERMINATED,
            'terminated_at' => now(),
        ]);
    }
}
