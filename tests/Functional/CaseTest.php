<?php

namespace App\Tests\Functional;

use App\Tests\Functional\Helper\AuthorizationTrait;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ApiHelperTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiHelperTestTrait;
use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;

abstract class CaseTest extends AbstractWebCaseTest implements ApiBrowserTestInterface, ApiHelperTestInterface
{
    use ApiHelperTestTrait, ApiBrowserTestTrait, AuthorizationTrait;

//region SECTION: Protected
    protected function setUp(): void
    {
        static::$default = static::defaultData();

        $this->setUrl();

        $this->client = $this->getAuthorizationClient();
    }

    protected function tearDown(): void
    {

    }
//endregion Protected
}