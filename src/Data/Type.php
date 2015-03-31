<?php

namespace Silktide\SemRushApi\Data;

abstract class Type
{

    use ConstantTrait;

    const TYPE_DOMAIN_RANKS = "domain_ranks";
    const TYPE_DOMAIN_RANK = "domain_rank";
    const TYPE_DOMAIN_RANK_HISTORY = "domain_rank_history";
    const TYPE_DOMAIN_ADWORDS = "domain_adwords";
    const TYPE_DOMAIN_ADWORDS_UNIQUE = "domain_adwords_unique";

    /**
     * Get all the possible columns
     *
     * @return string[]
     */
    public static function getTypes()
    {
        return self::getConstants();
    }
} 