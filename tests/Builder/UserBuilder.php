<?php

declare(strict_types=1);

namespace Tests\Builder;

use App\Domain\Project\Project;
use App\Domain\User\User;
use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Tests\Builder\Stub\StubUser;

final class UserBuilder
{
    private int $id;
    private string $name;
    private string $email;
    private ?DateTimeInterface $email_verified_at;
    private string $password;
    private ?string $remember_token;
    private ?DateTimeInterface $deleted_at;
    private DateTimeInterface $created_at;
    private DateTimeInterface $updated_at;

    /** Relationships */
    private Collection $projects;

    public function __construct()
    {
        $this->id = 1;
        $this->name = 'lggt';
        $this->email = 'test@lggt.com';
        $this->email_verified_at = null;
        $this->password = '$2y$10$92IXUNpjO';
        $this->remember_token = null;
        $this->deleted_at = null;
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();

        /** Relationships */
        $this->projects = new Collection([]);
    }

    public function build(): User
    {
        $user = new StubUser();
        $user->setDateFormat('Y-m-d');
        $user->id = $this->id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->email_verified_at = $this->email_verified_at;
        $user->password = $this->password;
        $user->remember_token = $this->remember_token;
        $user->deleted_at = $this->deleted_at;
        $user->created_at = $this->created_at;
        $user->updated_at = $this->updated_at;

        /** Relationships */
        $user->projects = $this->projects;

        return $user;
    }

    public function withId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function deleted(): self
    {
        $this->deleted_at = new DateTimeImmutable();

        return $this;
    }

    public function withProject(Project $project = null): self
    {
        $this->projects->push($project ?? (new ProjectBuilder())->build());

        return $this;
    }
}
