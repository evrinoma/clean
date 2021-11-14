<?php


namespace App\Menu;


use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\MenuBundle\Entity\MenuItem;
use Evrinoma\MenuBundle\Menu\MenuInterface;
use Evrinoma\UtilsBundle\Voter\RoleInterface;

/**
 * Class ApiDocMenu
 *
 * @package App\Menu
 */
final class ApiDocMenu implements MenuInterface
{

    public function create(EntityManagerInterface $em): void
    {
        $apiDocInternal = new MenuItem();
        $apiDocInternal
            ->setRole([RoleInterface::ROLE_SUPER_ADMIN])
            ->setName('Internal')
            ->setRoute('app.swagger_ui.evrinoma')
            ->setTag($this->tag());

        $em->persist($apiDocInternal);

        $apiDoc = new MenuItem();
        $apiDoc
            ->setRole([RoleInterface::ROLE_SUPER_ADMIN, RoleInterface::ROLE_API])
            ->setName('ApiDoc')
            ->setUri('#')
            ->addChild($apiDocInternal)
            ->setTag($this->tag());

        $em->persist($apiDoc);
    }

    public function order(): int
    {
        return 10;
    }

    public function tag(): string
    {
        return MenuInterface::DEFAULT_TAG;
    }
}