<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\CaseTest;
use App\Tests\Functional\DataFixtures\FixtureInterface;
use Evrinoma\TestUtilsBundle\Action\ActionTestInterface;
use Psr\Container\ContainerInterface;

final class DashBoardTest extends CaseTest
{
//region SECTION: Fields
    protected string $actionServiceName = 'App\Tests\Functional\Action\DashBoard';
//endregion Fields

//region SECTION: Protected
    protected function getActionService(ContainerInterface $container): ActionTestInterface
    {
        return $container->get($this->actionServiceName);
    }

    protected function getEntityClass(): string
    {
        return static::class;
    }
//endregion Protected

//region SECTION: Getters/Setters
    public static function getFixtures(): array
    {
        return [FixtureInterface::FOS_USER_FIXTURES];
    }
//endregion Getters/Setters
}