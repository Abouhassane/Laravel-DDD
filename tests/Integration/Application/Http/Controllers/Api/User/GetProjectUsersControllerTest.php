<?php

declare(strict_types=1);

namespace Tests\Integration\Application\Http\Controllers\Api\User;

use Tests\Integration\IntegrationTestCase;

final class GetProjectUsersControllerTest extends IntegrationTestCase
{
    public function testItGetsUserProjectsGroupedByStatus(): void
    {
        // Arrange
        $params = [
            'project' => 1,
        ];

        // Act
        $response = $this->post(route('api.project.users', $params));
        $results = $response->decodeResponseJson()['results'];

        // Assert
        $response->assertStatus(200);
        $this->assertCount(1, $results);
    }
}
