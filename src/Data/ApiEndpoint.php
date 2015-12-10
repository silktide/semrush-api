<?php
/**
 * Created by PhpStorm.
 * User: anca
 * Date: 5/28/15
 * Time: 1:45 PM
 */

namespace Silktide\SemRushApi\Data;


abstract class ApiEndpoint {

    use ConstantTrait;

    const ENDPOINT_DOMAIN = "/";
    const ENDPOINT_ANALYTICS = "/analytics/v1/";

    /**
     * Get all the possible columns
     *
     * @return string[]
     */
    public static function getApiEndpoints()
    {
        return self::getConstants();
    }
}