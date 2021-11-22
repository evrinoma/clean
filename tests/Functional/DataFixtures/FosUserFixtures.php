<?php

namespace App\Tests\Functional\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class FosUserFixtures extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{

//region SECTION: Public
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->createTypes($manager);

        $manager->flush();
    }
//endregion Public

//region SECTION: Private
    private function createTypes(ObjectManager $manager)
    {
        $short  = (new \ReflectionClass(User::class))->getShortName()."_";

        $i      = 0;
        $entity = new User();
        $entity
            ->setUsername('nikolns')
            ->setUsernameCanonical('nikolns')
            ->setEmail('nikolns@ite-ng.ru')
            ->setEmailCanonical('nikolns@ite-ng.ru')
            ->setEnabled(true)
            ->setLastLogin(new \DateTime('2021-11-22 13:59:37'))
            ->setRoles( unserialize('a:2:{i:0;s:16:"ROLE_SUPER_ADMIN";i:1;s:17:"ROLE_PRIOR_BUDGET";}'))
            ->setPassword('nikolns')
        ;

        $this->addReference($short.$i, $entity);
        $manager->persist($entity);

        return $this;
    }

//endregion Private

//region SECTION: Getters/Setters
    public static function getGroups(): array
    {
        return [
            FixtureInterface::FOS_USER_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}