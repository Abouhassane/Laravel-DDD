<?php

namespace Tests\Integration;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends IntegrationTestCase
{
    public function testTheApplicationReturnsASuccessfulResponse(): void
    {
        // Arrange
        $url = '/';

        // Act
        $response = $this->get($url);

        // Assert
        $response->assertStatus(200);
    }
}
