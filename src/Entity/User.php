<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\VacationBundle\Model\User\VacationInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Class User
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements VacationInterface
{
//region SECTION: Fields
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="plain", type="string", nullable=true)
     */
    private $plain;

//endregion Fields

//region SECTION: Constructor
    public function __construct()
    {
        parent::__construct();
    }
//endregion Constructor

//region SECTION: Getters/Setters
    /**
     * @return string
     */
    public function getPlain(): string
    {
        return $this->plain;
    }

    /**
     * @param string $plain
     *
     * @return User
     */
    public function setPlain(string $plain)
    {
        $this->plain = $plain;

        return $this;
    }
//endregion Getters/Setters
}