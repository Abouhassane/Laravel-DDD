<?php

declare(strict_types=1);

namespace Tests\Integration\Application\Http\Controllers\Api\Project;

use App\Domain\Project\ProjectStatus;
use Tests\Integration\IntegrationTestCase;

final class GetUserProjectsByStatusControllerTest extends IntegrationTestCase
{
    public function testItGetsUserProjectsGroupedByStatus(): void
    {
        // Arrange
        $params = [
            'group_by_status' => true,
        ];

        // Act
        $response = $this->post(route('api.user.projects', ['user' => 1]), $params);
        $results = $response->decodeResponseJson()['results'];

        // Assert
        $response->assertStatus(200);
        $this->assertCount(2, $results[ProjectStatus::IN_PROGRESS->value]);
        $this->assertCount(1, $results[ProjectStatus::BLOCKED->value]);
        $this->assertCount(1, $results[ProjectStatus::TERMINATED->value]);
    }

    public function testItGetsAllUserProjectsFlattened(): void
    {
        // Arrange
        $params = [
            'group_by_status' => false,
        ];

        // Act
        $response = $this->post(route('api.user.projects', ['user' => 1]), $params);
        $results = $response->decodeResponseJson()['results'];

        // Assert
        $response->assertStatus(200);
        $this->assertCount(4, $results);
    }
}
