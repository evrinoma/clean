<?php


namespace App\Menu;


use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\MenuBundle\Entity\MenuItem;
use Evrinoma\MenuBundle\Menu\MenuInterface;
use Evrinoma\UtilsBundle\Voter\RoleInterface;

/**
 * Class ServiceMenu
 *
 * @package App\Menu
 */
final class ServiceMenu implements MenuInterface
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
            ->setRoute('core_clear_cache')
            ->setTag($this->tag());

        $em->persist($cache);

        $service = new MenuItem();
        $service
            ->setRole([RoleInterface::ROLE_USER])
            ->setName('Service')
            ->setUri('#')
            ->addChild($home)
            ->addChild($cache)
            ->setTag($this->tag());

        $em->persist($service);
    }

    public function order(): int
    {
        return 20;
    }

    public function tag(): string
    {
        return MenuInterface::DEFAULT_TAG;
    }
}