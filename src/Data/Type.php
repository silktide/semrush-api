<?php

namespace Silktide\SemRushApi\Data;

abstract class Type
{

    use ConstantTrait;

    const TYPE_DOMAIN_RANKS = "domain_ranks";
    const TYPE_DOMAIN_RANK = "domain_rank";
    const TYPE_DOMAIN_RANK_HISTORY = "domain_rank_history";
    const TYPE_DOMAIN_ORGANIC = "domain_organic";
    const TYPE_DOMAIN_ADWORDS = "domain_adwords";
    const TYPE_DOMAIN_ADWORDS_UNIQUE = "domain_adwords_unique";
    const TYPE_ADVERTISER_PUBLISHERS = "advertiser_publishers";
    const TYPE_ADVERTISER_DISPLAY_ADS = "advertiser_text_ads";
    const TYPE_ADVERTISER_RANK = "advertiser_rank";
    const TYPE_DOMAIN_PLA_SEARCH_KEYWORDS = "domain_shopping";
    const TYPE_KEYWORD_DIFFICULTY = "phrase_kdi";

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
