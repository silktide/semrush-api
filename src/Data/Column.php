<?php


namespace AndyWaite\SemRushApi\Data;

abstract class Column {

    use ConstantTrait;

    const COLUMN_ADWORDS_BUDGET = "Ac";
    const COLUMN_ADWORDS_KEYWORDS = "Ad";
    const COLUMN_ADWORDS_TRAFFIC = "At";
    const COLUMN_DATABASE = "Db";
    const COLUMN_DOMAIN = "Dn";
    const COLUMN_ORGANIC_BUDGET = "Oc";
    const COLUMN_ORGANIC_KEYWORDS = "Or";
    const COLUMN_ORGANIC_TRAFFIC = "Ot";
    const COLUMN_SEMRUSH_RATING = "Rk";

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