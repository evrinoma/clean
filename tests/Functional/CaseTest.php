<?php

namespace App\Tests\Functional;

use App\Tests\Functional\Helper\AuthorizationTrait;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;

abstract class CaseTest extends AbstractWebCaseTest
{
    use AuthorizationTrait, ApiBrowserTestTrait;

    protected function setUp(): void
    {
        static::$default = static::defaultData();

        $this->setUrl();

        $this->client = $this->getAuthorizationClient();
    }

    protected function tearDown(): void
    {

    }
}