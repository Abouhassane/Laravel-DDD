<?php

declare(strict_types=1);

namespace Tests\Builder;

use App\Domain\Project\Project;
use App\Domain\Project\ProjectStatus;
use App\Domain\User\User;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Tests\Builder\Stub\StubProject;

final class ProjectBuilder
{
    private int $id;
    private string $title;
    private ProjectStatus $status;
    private float $funds;
    private ?DateTimeInterface $started_at;
    private ?DateTimeInterface $blocked_at;
    private ?DateTimeInterface $terminated_at;
    private ?DateTimeInterface $deleted_at;
    private DateTimeInterface $created_at;
    private DateTimeInterface $updated_at;

    /** Relationships */
    private Collection $users;

    public function __construct()
    {
        $this->id = 1;
        $this->title = 'project_sample';
        $this->status = ProjectStatus::GENERATED;
        $this->funds = 23656.67;
        $this->started_at = null;
        $this->blocked_at = null;
        $this->terminated_at = null;
        $this->deleted_at = null;
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();

        /** Relationships */
        $this->users = new Collection([]);
    }

    public function build(): Project
    {
        $project = new StubProject();
        $project->setDateFormat('Y-m-d');
        $project->id = $this->id;
        $project->title = $this->title;
        $project->status = $this->status;
        $project->funds = $this->funds;
        $project->started_at = $this->started_at;
        $project->blocked_at = $this->blocked_at;
        $project->terminated_at = $this->terminated_at;
        $project->deleted_at = $this->deleted_at;
        $project->created_at = $this->created_at;
        $project->updated_at = $this->updated_at;

        /** Relationships */
        $project->users = $this->users;

        return $project;
    }

    public function withId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function withFunds(float $funds): self
    {
        $this->funds = $funds;

        return $this;
    }

    public function withInProgressStatus(): self
    {
        $this->status = ProjectStatus::IN_PROGRESS;
        $this->started_at = new DateTimeImmutable();

        return $this;
    }

    public function withBlockedStatus(): self
    {
        $this->status = ProjectStatus::BLOCKED;
        $this->blocked_at = new DateTimeImmutable();

        return $this;
    }

    public function withTerminatedStatus(): self
    {
        $this->status = ProjectStatus::TERMINATED;
        $this->terminated_at = new DateTimeImmutable();

        return $this;
    }

    public function deleted(): self
    {
        $this->deleted_at = new DateTimeImmutable();

        return $this;
    }

    public function withUser(User $user = null): self
    {
        $this->users->push($user ?? (new UserBuilder())->build());

        return $this;
    }
}
