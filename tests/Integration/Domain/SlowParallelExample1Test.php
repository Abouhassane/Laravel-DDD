<?php

declare(strict_types=1);

namespace Tests\Integration\Domain;

use Tests\Integration\IntegrationTestCase;

final class SlowParallelExample1Test extends IntegrationTestCase
{
    public function testTrueIsTrue(): void
    {
        sleep(2);
        $this->assertTrue(true);
    }
}
