<?php


namespace App\Menu;


use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\MenuBundle\Entity\MenuItem;
use Evrinoma\MenuBundle\Menu\MenuInterface;
use Evrinoma\SecurityBundle\Voter\RoleInterface;

/**
 * Class ApiDocMenu
 *
 * @package App\Menu
 */
final class HomeMenu implements MenuInterface
{

    public function create(EntityManagerInterface $em): void
    {

        $home = new MenuItem();
        $home
            ->setRole([RoleInterface::ROLE_USER])
            ->setName('Home')
            ->setRoute('core_home')
            ->setTag($this->tag());

        $em->persist($home);

        $cache = new MenuItem();
        $cache
            ->setRole([RoleInterface::ROLE_USER])
            ->setName('ClearCache')
            ->setRoute('clear_cache')
            ->setTag($this->tag());


        $apiDoc = new MenuItem();
        $apiDoc
            ->setRole([RoleInterface::ROLE_USER])
            ->setName('Service')
            ->setUri('#')
            ->addChild($home)
            ->addChild($cache)
            ->setTag($this->tag());

        $em->persist($apiDoc);
    }

    public function order(): int
    {
        return 11;
    }

    public function tag(): string
    {
        return MenuInterface::DEFAULT_TAG;
    }
}