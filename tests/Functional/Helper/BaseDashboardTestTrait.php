<?php

namespace App\Tests\Functional\Helper;

use PHPUnit\Framework\Assert;

trait BaseDashboardTestTrait
{
//region SECTION: Protected
    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey('system', $entity);
        Assert::assertArrayHasKey('procinfo', $entity['system']);
        Assert::assertArrayHasKey('sysinfo', $entity['system']);
    }
//endregion Protected
}