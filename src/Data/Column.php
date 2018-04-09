<?php

namespace Silktide\SemRushApi\Data;

abstract class Column
{
    use ConstantTrait;

    const COLUMN_OVERVIEW_ADWORDS_BUDGET = "Ac";
    const COLUMN_OVERVIEW_ADWORDS_KEYWORDS = "Ad";
    const COLUMN_OVERVIEW_ADWORDS_TRAFFIC = "At";
    const COLUMN_OVERVIEW_DATABASE = "Db";
    const COLUMN_OVERVIEW_DOMAIN = "Dn";
    const COLUMN_OVERVIEW_ORGANIC_BUDGET = "Oc";
    const COLUMN_OVERVIEW_ORGANIC_KEYWORDS = "Or";
    const COLUMN_OVERVIEW_ORGANIC_TRAFFIC = "Ot";
    const COLUMN_OVERVIEW_SEMRUSH_RATING = "Rk";
    const COLUMN_OVERVIEW_PLA_UNIQUES = "Sv";
    const COLUMN_OVERVIEW_PLA_KEYWORDS = "Sh";
    const COLUMN_OVERVIEW_DATE = "Dt";
    const COLUMN_DOMAIN_KEYWORD = "Ph";
    const COLUMN_DOMAIN_KEYWORD_ORGANIC_POSITION = "Po";
    const COLUMN_DOMAIN_KEYWORD_PREVIOUS_ORGANIC_POSITION = "Pp";
    const COLUMN_KEYWORD_AVERAGE_QUERIES = "Nq";
    const COLUMN_KEYWORD_AVERAGE_CLICK_PRICE = "Cp";
    const COLUMN_DOMAIN_KEYWORD_TRAFFIC_PERCENTAGE = "Tr";
    const COLUMN_KEYWORD_ESTIMATED_PRICE = "Tc";
    const COLUMN_KEYWORD_COMPETITIVE_AD_DENSITY = "Co";
    const COLUMN_KEYWORD_ORGANIC_NUMBER_OF_RESULTS = "Nr";
    const COLUMN_KEYWORD_INTEREST = "Td";
    const COLUMN_DOMAIN_KEYWORD_AD_TITLE = "Tt";
    const COLUMN_DOMAIN_KEYWORD_AD_TEXT = "Ds";
    const COLUMN_DOMAIN_KEYWORD_VISIBLE_URL = "Vu";
    const COLUMN_DOMAIN_KEYWORD_TARGET_URL = "Ur";
    const COLUMN_DOMAIN_KEYWORD_NUMBER = "Pc";
    const COLUMN_DOMAIN_KEYWORD_POSITION_DIFFERENCE = "Pd";
    const COLUMN_DOMAIN_ADWORD_POSITION = "Ab";
    const COLUMN_KEYWORD_DIFFICULTY_INDEX = "Kd";
    const COLUMN_DOMAIN_KEYWORD_SHOP_NAME = "Sn";
    const COLUMN_DOMAIN_KEYWORD_PRODUCT_PRICE = "Pr";
    const COLUMN_TIMESTAMP = "Ts";
    const COLUMN_ADVERTISER_AD_DOMAIN = "domain";
    const COLUMN_ADVERTISER_AD_COUNT = "ads_count";
    const COLUMN_ADVERTISER_AD_FIRST_SEEN = "first_seen";
    const COLUMN_ADVERTISER_AD_LAST_SEEN = "last_seen";
    const COLUMN_ADVERTISER_AD_TIMES_SEEN = "times_seen";
    const COLUMN_ADVERTISER_AD_TITLE = "title";
    const COLUMN_ADVERTISER_AD_TEXT = "text";
    const COLUMN_ADVERTISER_AD_URL = "visible_url";
    const COLUMN_ADVERTISER_ADS_OVERALL = "ads_overall";
    const COLUMN_ADVERTISER_MEDIA_ADS_OVERALL = "media_ads_overall";
    const COLUMN_ADVERTISER_TEXT_ADS_OVERALL = "text_ads_overall";
    const COLUMN_ADVERTISER_DOMAIN_OVERALL = "domain_overall";
    const COLUMN_TOTAL = "total";
    const COLUMN_DOMAINS_NUM = "domains_num";
    const COLUMN_URLS_NUM = "urls_num";
    const COLUMN_IPS_NUM = "ips_num";
    const COLUMN_IPCLASSC_NUM = "ipclassc_num";
    const COLUMN_TEXTS_NUM = "texts_num";
    const COLUMN_FOLLOWS_NUM = "follows_num";
    const COLUMN_FORMS_NUM = "forms_num";
    const COLUMN_NOFOLLOWS_NUM = "nofollows_num";
    const COLUMN_FRAMES_NUM = "frames_num";
    const COLUMN_IMAGES_NUM = "images_num";
    const COLUMN_SCORE = "score";
    const COLUMN_TRUST_SCORE = "trust_score";

    /**
     * Get all the possible columns
     *
     * @return string[]
     */
    public static function getColumns()
    {
        return self::getConstants();
    }

    /**
     * Check if the given code is a valid column code
     *
     * @param string $code
     * @return bool
     */
    public static function isValidColumn($code)
    {
        return in_array($code, self::getColumns());
    }
}
