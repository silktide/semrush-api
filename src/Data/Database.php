<?php

namespace Silktide\SemRushApi\Data;

abstract class Database
{

    use ConstantTrait;

    const DATABASE_GOOGLE_US = "us";
    const DATABASE_GOOGLE_UK = "uk";
    const DATABASE_GOOGLE_CA = "ca";
    const DATABASE_GOOGLE_RU = "ru";
    const DATABASE_GOOGLE_DE = "de";
    const DATABASE_GOOGLE_FR = "fr";
    const DATABASE_GOOGLE_ES = "es";
    const DATABASE_GOOGLE_IT = "it";
    const DATABASE_GOOGLE_BR = "br";
    const DATABASE_GOOGLE_AU = "au";
    const DATABASE_BING_US = "bing-us";
    const DATABASE_GOOGLE_AR = "ar";
    const DATABASE_GOOGLE_BE = "be";
    const DATABASE_GOOGLE_CH = "ch";
    const DATABASE_GOOGLE_DK = "dk";
    const DATABASE_GOOGLE_FI = "fi";
    const DATABASE_GOOGLE_HK = "hk";
    const DATABASE_GOOGLE_IE = "ie";
    const DATABASE_GOOGLE_IL = "il";
    const DATABASE_GOOGLE_MX = "mx";
    const DATABASE_GOOGLE_NL = "nl";
    const DATABASE_GOOGLE_NO = "no";
    const DATABASE_GOOGLE_PL = "pl";
    const DATABASE_GOOGLE_SE = "se";
    const DATABASE_GOOGLE_SG = "sg";
    const DATABASE_GOOGLE_TR = "tr";

    /**
     * Get all the possible databases
     *
     * @return string[]
     */
    public static function getDatabases()
    {
        return self::getConstants();
    }
} 