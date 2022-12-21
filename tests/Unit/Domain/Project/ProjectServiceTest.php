<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Project;

use App\Domain\Project\ProjectService;
use App\Domain\Project\ProjectStatus;
use App\Domain\Project\Repositories\ProjectRepository;
use Illuminate\Support\Collection;
use Mockery;
use Mockery\MockInterface;
use Tests\Builder\ProjectBuilder;
use Tests\Builder\UserBuilder;
use Tests\Unit\UnitTestCase;

final class ProjectServiceTest extends UnitTestCase
{
    private ProjectRepository & MockInterface $projectRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->projectRepository = Mockery::mock(ProjectRepository::class);
        $this->sut = new ProjectService($this->projectRepository);
    }

    public function testItGroupsUserProjectsByStatus(): void
    {
        // Arrange
        $generatedProject = (new ProjectBuilder())->build();
        $progressingProject = (new ProjectBuilder())
            ->withInProgressStatus()
            ->build();
        $progressingDeletedProject = (new ProjectBuilder())
            ->deleted()
            ->withInProgressStatus()
            ->build();
        $blockedProject = (new ProjectBuilder())
            ->withBlockedStatus()
            ->build();
        $terminatedProject = (new ProjectBuilder())
            ->withTerminatedStatus()
            ->build();

        $user = (new UserBuilder())->build();

        $this->projectRepository->shouldReceive('getAllUserProjectsWithTrashedOnes')
            ->andReturn(
                new Collection([
                    $generatedProject,
                    $progressingProject,
                    $progressingDeletedProject,
                    $blockedProject,
                    $terminatedProject,
                ])
            );

        // Act
        $result = $this->sut->getAllUserProjectsGroupedByStatus($user);

        // Assert
        $this->assertCount(1, $result->get(ProjectStatus::GENERATED->value));
        $this->assertCount(2, $result->get(ProjectStatus::IN_PROGRESS->value));
        $this->assertCount(1, $result->get(ProjectStatus::BLOCKED->value));
        $this->assertCount(1, $result->get(ProjectStatus::TERMINATED->value));
    }
}
