<?php

declare(strict_types=1);

namespace Builder;

use Builder\Stub\StubUser;
use DateTimeImmutable;
use DateTimeInterface;

final class UserBuilder
{
    private int $id;
    private string $name;
    private string $email;
    private ?DateTimeInterface $email_verified_at;
    private string $password;
    private ?string $remember_token;
    private DateTimeInterface $created_at;
    private DateTimeInterface $updated_at;

    public function __construct()
    {
        $this->id = 1;
        $this->name = 'lggt';
        $this->email = 'test@lggt.com';
        $this->email_verified_at = null;
        $this->password = '$2y$10$92IXUNpjO';
        $this->remember_token = null;
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
    }

    public function build(): StubUser
    {
        $user = new StubUser();
        $user->setDateFormat('Y-m-d');
        $user->id = $this->id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->email_verified_at = $this->email_verified_at;
        $user->password = $this->password;
        $user->remember_token = $this->remember_token;
        $user->created_at = $this->created_at;
        $user->updated_at = $this->updated_at;

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
}
