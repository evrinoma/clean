<?php
/**
 * Created by PhpStorm.
 * User: nikolns
 * Date: 7/4/19
 * Time: 1:43 PM
 */

namespace App\Rest\Model;

/**
 * Class RestModel
 *
 * @package App\Rest\Model
 */
abstract class RestModel
{
//region SECTION: Fields
    public const SUCCESS_OK      = 200;
    public const SUCCESS_CREATED = 201;

    public const CLIENT_ERROR_BAD_REQUEST = 400;
    public const CLIENT_ERROR_CONFLICT    = 409;
    public const CLIENT_ERROR_GONE        = 410;


    public const SERVER_ERROR_INTERNAL_ERROR      = 500;
    public const SERVER_ERROR_SERVICE_UNAVAILABLE = 503;
    public const SERVER_ERROR_UNKNOWN_ERROR       = 520;
//endregion Fields
}