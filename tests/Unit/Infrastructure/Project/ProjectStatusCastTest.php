<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Project;

use App\Domain\Project\ProjectStatus;
use App\Infrastructure\Project\ProjectStatusCast;
use InvalidArgumentException;
use Tests\Builder\ProjectBuilder;
use Tests\Unit\UnitTestCase;

final class ProjectStatusCastTest extends UnitTestCase
{
    private ProjectStatusCast $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new ProjectStatusCast();
    }

    public function testItThrowsAnExceptionFetchingAProjectStatusFromAnInvalidValue(): void
    {
        // Arrange
        $project = (new ProjectBuilder())->build();
        $key = 'status';
        $invalidProjectStatus = 7;
        $attributes = [];

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot fetch a ProjectStatus value from "7"');

        // Act
        $this->castValueToProjectStatus($project, $key, $invalidProjectStatus, $attributes);
    }

    public function testItCastValueToAProjectStatus(): void
    {
        // Arrange
        $project = (new ProjectBuilder())->build();
        $key = 'status';
        $invalidProjectStatus = 1;
        $attributes = [];

        // Act
        $result = $this->castValueToProjectStatus($project, $key, $invalidProjectStatus, $attributes);

        // Assert
        $this->assertSame(ProjectStatus::IN_PROGRESS, $result);
    }

    public function testItThrowsAnExceptionGivenAValueThatIsNotAProjectStatus(): void
    {
        // Arrange
        $project = (new ProjectBuilder())->build();
        $key = 'status';
        $invalidProjectStatus = 'invalid_project_status';
        $attributes = [];

        // Assert
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The given value "invalid_project_status" is not a ProjectStatus');

        // Act
        $this->castProjectStatusToInteger($project, $key, $invalidProjectStatus, $attributes);
    }

    public function testItCastProjectStatusToAnIntegerValue(): void
    {
        // Arrange
        $project = (new ProjectBuilder())->build();
        $key = 'status';
        $status = ProjectStatus::TERMINATED;
        $attributes = [];

        // Act
        $result = $this->castProjectStatusToInteger($project, $key, $status, $attributes);

        // Assert
        $this->assertSame(3, $result);
    }

    private function castValueToProjectStatus($model, $key, $value, $attibutes): ProjectStatus
    {
        return $this->sut->get($model, $key, $value, $attibutes);
    }

    private function castProjectStatusToInteger($model, $key, $value, $attibutes): int
    {
        return $this->sut->set($model, $key, $value, $attibutes);
    }
}
