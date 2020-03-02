<?php
/**
 * Created by PhpStorm.
 * User: nikolns
 * Date: 12/5/19
 * Time: 3:34 PM
 */

namespace App\Interfaces;

/**
 * Interface RoleInterface
 *
 * @package App\Interfaces
 */
interface RoleInterface
{
//region SECTION: Fields
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_API = 'ROLE_API';
    public const ROLE_NO_LDAP_USER = 'ROLE_NO_LDAP_USER';
//endregion Fields
}