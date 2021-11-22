<?php

namespace App\Tests\Functional;

use App\Tests\Functional\Helper\AuthorizationTrait;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestTrait;
use Evrinoma\TestUtilsBundle\Helper\AbstractSymfony;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestTrait;
use Evrinoma\TestUtilsBundle\Helper\DoctrineTestTrait;
use Evrinoma\TestUtilsBundle\Helper\ResponseStatusTestTrait;
use Evrinoma\TestUtilsBundle\Web\AbstractWebCaseTest;

abstract class CaseTest extends AbstractWebCaseTest  implements ApiBrowserTestInterface, ApiMethodTestInterface
{
    use ApiMethodTestTrait, ApiBrowserTestTrait, AuthorizationTrait, DoctrineTestTrait, ResponseStatusTestTrait;

//region SECTION: Protected
    protected function setUp(): void
    {
        self::bootKernel();

        parent::setUp();

        $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;

        $this->setEntityManager($container);

        $this->getAuthorization($container, $this->client);
    }

    protected function tearDown(): void
    {

    }
//endregion Protected
}