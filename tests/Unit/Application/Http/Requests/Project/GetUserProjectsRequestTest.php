<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Http\Requests\Project;

use App\Application\Http\Requests\Project\GetUserProjectsRequest;
use App\Domain\Project\ProjectStatus;
use Tests\Builder\UserBuilder;
use Tests\Unit\Application\Http\Requests\Helpers\StubRepository;
use Tests\Unit\Application\Http\Requests\RequestTestCase;

final class GetUserProjectsRequestTest extends RequestTestCase
{
    public function testItDoesNotValidateRequestWhenGroupByStatusParamIsNotProvided(): void
    {
        // Arrange
        $params = [];

        // Act && Assert
        $this->assertFalse($this->validateParameters($params));
    }

    public function testItDoesNotValidateRequestWhenUserDoesNotExist(): void
    {
        // Arrange
        $params = [
            'group_by_status' => true,
            'user_id' => 444,
        ];

        // Act && Assert
        $this->assertFalse($this->validateParameters($params));
    }

    public function testItDoesNotValidateRequestWhenProjectStatusIsInvalid(): void
    {
        // Arrange
        $params = [
            'group_by_status' => true,
            'status' => 444,
        ];

        // Act && Assert
        $this->assertFalse($this->validateParameters($params));
    }

    public function testItValidatesRequestWhenAllParamsAreValid(): void
    {
        // Arrange
        $user = (new UserBuilder())->withId(444)->build();
        StubRepository::addToRepository($user);

        $params = [
            'group_by_status' => true,
            'user_id' => $user->id,
            'status' => ProjectStatus::TERMINATED,
        ];

        // Act && Assert
        $this->assertTrue($this->validateParameters($params));
    }

    protected function getRequestUnderTest(): string
    {
        return GetUserProjectsRequest::class;
    }
}
