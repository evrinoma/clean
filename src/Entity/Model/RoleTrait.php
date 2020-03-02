<?php
/**
 * Created by PhpStorm.
 * User: nikolns
 * Date: 12/5/19
 * Time: 3:29 PM
 */

namespace App\Entity\Model;

/**
 * Trait RoleTrait
 *
 * @package App\Entity\Model
 */
trait RoleTrait
{
    /**
     * @var array
     * @ORM\Column(name="role", type="array", nullable=true)
     */
    protected $role;

    /**
     * @return array|null
     */
    public function getRole(): ?array
    {
        return $this->role;
    }


    /**
     * @param array $role
     *
     * @return self
     */
    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return self
     */
    public function addRole($role): self
    {
        $this->role[] = $role;

        return $this;
    }
}