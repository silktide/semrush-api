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
} 