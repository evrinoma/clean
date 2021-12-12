<?php

namespace App\Tests\Functional;

use App\Tests\Functional\Helper\AuthorizationTrait;
use Evrinoma\TestUtilsBundle\Functional\AbstractFunctionalTest;
use Evrinoma\TestUtilsBundle\Helper\AbstractSymfony;
use Evrinoma\TestUtilsBundle\Helper\DoctrineTestTrait;

abstract class CaseTest extends AbstractFunctionalTest
{
    use AuthorizationTrait, DoctrineTestTrait;

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