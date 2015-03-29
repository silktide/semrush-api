<?php


namespace AndyWaite\SemRushApi\Data;

use AndyWaite\SemRushApi\Data\Exception\UnsupportedTypeException;

abstract class Type {

    use ConstantTrait;

    const TYPE_DOMAIN_RANK = "domain_rank";
    const TYPE_DOMAIN_RANKS = "domain_ranks";

    /**
     * Get all the possible columns
     *
     * @return string[]
     */
    public static function getTypes()
    {
        return self::getConstants();
    }

    /**
     * @param string $type
     * @return string[]
     */
    public static function getDefaultColumns($type)
    {
        $types = [
            self::TYPE_DOMAIN_RANKS => [
                Column::COLUMN_DATABASE,
                Column::COLUMN_DOMAIN,
                Column::COLUMN_SEMRUSH_RATING,
                Column::COLUMN_ORGANIC_KEYWORDS,
                Column::COLUMN_ORGANIC_TRAFFIC,
                Column::COLUMN_ORGANIC_BUDGET,
                Column::COLUMN_ADWORDS_KEYWORDS,
                Column::COLUMN_ADWORDS_TRAFFIC,
                Column::COLUMN_ADWORDS_BUDGET
            ]
        ];

        if (!isset($types[$type])) {
            throw new UnsupportedTypeException("The type of request [{$type}] is not currently supported.");
        }

        return $types[$type];
    }
} 