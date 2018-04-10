<?php

namespace Silktide\SemRushApi\Data;

abstract class TypeAPITypeMap
{
    use ConstantTrait;

    const AVAILABLE_ANALYTICS_TYPES = [
        Type::TYPE_BACKLINKS_OVERVIEW,
        Type::TYPE_BACKLINKS,
        Type::TYPE_BACKLINKS_REFERRING_DOMAINS,
        Type::TYPE_BACKLINKS_REFERRING_IPS,
        Type::TYPE_BACKLINKS_INDEXED_PAGES
    ];

    /**
     * @param string $type
     * @return int
     */
    public static function getAPIType($type)
    {
        if (in_array($type, self::AVAILABLE_ANALYTICS_TYPES)) {
            return 'analytics';
        }

        return;
    }
}
