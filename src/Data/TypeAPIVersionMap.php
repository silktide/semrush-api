<?php

namespace Silktide\SemRushApi\Data;

abstract class TypeAPIVersionMap
{
    use ConstantTrait;

    const AVAILABLE_v2_TYPES = [
        Type::TYPE_ADVERTISER_PUBLISHERS,
        Type::TYPE_ADVERTISER_DISPLAY_ADS,
        Type::TYPE_ADVERTISER_RANK
    ];

    /**
     * @param string $type
     * @return int
     */
    public static function getAPIVersion($type)
    {
        if (in_array($type, self::AVAILABLE_v2_TYPES)) {
            return 2;
        }

        return 1;
    }
}
