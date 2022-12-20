<?php

declare(strict_types=1);

namespace Tests\Integration\Domain;

use Tests\Integration\IntegrationTestCase;

final class SlowParallelExample3Test extends IntegrationTestCase
{
    public function testTrueIsTrue(): void
    {
        sleep(20);
        $this->assertTrue(true);
    }
}
