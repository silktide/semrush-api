<?php

namespace Silktide\SemRushApi\Data;

abstract class TargetType
{

    use ConstantTrait;

    const TARGET_TYPE_DOMAIN = "domain";
    const TARGET_TYPE_ROOT_DOMAIN = "root_domain";
    const TARGET_TYPE_URL = "url";

    /**
     * Get all the possible columns
     *
     * @return string[]
     */
    public static function getTargetTypes()
    {
        return self::getConstants();
    }
}