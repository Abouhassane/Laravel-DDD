<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Http\Requests\User;

use App\Application\Http\Requests\User\GetProjectUsersRequest;
use Tests\Builder\ProjectBuilder;
use Tests\Builder\UserBuilder;
use Tests\Unit\Application\Http\Requests\Helpers\StubRepository;
use Tests\Unit\Application\Http\Requests\RequestTestCase;

final class GetProjectUsersRequestTest extends RequestTestCase
{
    public function testItValidatesRequestWhenProvidedParamsAreValid(): void
    {
        // Arrange
        $project = (new ProjectBuilder())
            ->withUser((new UserBuilder())->build())
            ->build();
        $params = [
            'project_title' => 'my_project_title',
            'email' => 'email@not.exisit',
        ];

        // Act && Assert
        $this->assertFalse(
            $this->validateWithRouteParameters(
                $params,
                ['project' => $project]
            ),
        );
    }

    public function testItDoesNotValidateRequestWhenProjectTitleIsLongerThan20Characters(): void
    {
        // Arrange
        $project = (new ProjectBuilder())
            ->withUser((new UserBuilder())->build())
            ->build();
        $params = [
            'project_title' => 'project_title_more_than_20_characters',
        ];

        // Act && Assert
        $this->assertFalse(
            $this->validateWithRouteParameters(
                $params,
                ['project' => $project]
            ),
        );
    }

    public function testItDoesNotValidateRequestWhenEmailIsNotUnique(): void
    {
        // Arrange
        $user1 = (new UserBuilder())->withId(1)->withEmail('email1@example.com')->build();

        $user2 = (new UserBuilder())->withId(2)->withEmail('email2@example.com')->build();
        $project = (new ProjectBuilder())
            ->withUser($user2)
            ->build();

        StubRepository::addToRepository($user1);
        StubRepository::addToRepository($user2);

        $params = [
            'email' => 'email1@example.com',
        ];

        // Act && Assert
        $this->assertFalse(
            $this->validateWithRouteParameters(
                $params,
                ['project' => $project]
            ),
        );
    }

    public function testItDoesNotValidateRequestWhenProjectTitleIsNotUnique(): void
    {
        // Arrange
        $user = (new UserBuilder())->withId(1)->build();
        $project = (new ProjectBuilder())
            ->withId(1)
            ->withUser($user)
            ->withTitle('project_title_1')
            ->build();

        StubRepository::addToRepository($user);
        StubRepository::addToRepository($project);

        $params = [
            'project_title' => 'project_title_1',
        ];

        // Act && Assert
        $this->assertFalse(
            $this->validateWithRouteParameters(
                $params,
                ['project' => $project]
            ),
        );
    }

    protected function getRequestUnderTest(): string
    {
        return GetProjectUsersRequest::class;
    }
}
