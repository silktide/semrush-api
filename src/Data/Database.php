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
    const DATABASE_MOBILE_US = "mobile-us";
    const DATABASE_GOOGLE_JP = "jp";
    const DATABASE_GOOGLE_IN = "in";
    const DATABASE_GOOGLE_HU = "hu";
    const DATABASE_GOOGLE_AF = "af";
    const DATABASE_GOOGLE_AL = "al";
    const DATABASE_GOOGLE_DZ = "dz";
    const DATABASE_GOOGLE_AO = "ao";
    const DATABASE_GOOGLE_AM = "am";
    const DATABASE_GOOGLE_AT = "at";
    const DATABASE_GOOGLE_AZ = "az";
    const DATABASE_GOOGLE_BH = "bh";
    const DATABASE_GOOGLE_BD = "bd";
    const DATABASE_GOOGLE_BY = "by";
    const DATABASE_GOOGLE_BZ = "bz";
    const DATABASE_GOOGLE_BO = "bo";
    const DATABASE_GOOGLE_BA = "ba";
    const DATABASE_GOOGLE_BW = "bw";
    const DATABASE_GOOGLE_BN = "bn";
    const DATABASE_GOOGLE_BG = "bg";
    const DATABASE_GOOGLE_CV = "cv";
    const DATABASE_GOOGLE_KH = "kh";
    const DATABASE_GOOGLE_CM = "cm";
    const DATABASE_GOOGLE_CL = "cl";
    const DATABASE_GOOGLE_CO = "co";
    const DATABASE_GOOGLE_CR = "cr";
    const DATABASE_GOOGLE_HR = "hr";
    const DATABASE_GOOGLE_CY = "cy";
    const DATABASE_GOOGLE_CZ = "cz";
    const DATABASE_GOOGLE_CD = "cd";
    const DATABASE_GOOGLE_DO = "do";
    const DATABASE_GOOGLE_EC = "ec";
    const DATABASE_GOOGLE_EG = "eg";
    const DATABASE_GOOGLE_SV = "sv";
    const DATABASE_GOOGLE_EE = "ee";
    const DATABASE_GOOGLE_ET = "et";
    const DATABASE_GOOGLE_GE = "ge";
    const DATABASE_GOOGLE_GH = "gh";
    const DATABASE_GOOGLE_GR = "gr";
    const DATABASE_GOOGLE_GT = "gt";
    const DATABASE_GOOGLE_GY = "gy";
    const DATABASE_GOOGLE_HT = "ht";
    const DATABASE_GOOGLE_HN = "hn";
    const DATABASE_GOOGLE_IS = "is";
    const DATABASE_GOOGLE_ID = "id";
    const DATABASE_GOOGLE_JM = "jm";
    const DATABASE_GOOGLE_JO = "jo";
    const DATABASE_GOOGLE_KZ = "kz";
    const DATABASE_GOOGLE_KW = "kw";
    const DATABASE_GOOGLE_LV = "lv";
    const DATABASE_GOOGLE_LB = "lb";
    const DATABASE_GOOGLE_LT = "lt";
    const DATABASE_GOOGLE_LU = "lu";
    const DATABASE_GOOGLE_MG = "mg";
    const DATABASE_GOOGLE_MY = "my";
    const DATABASE_GOOGLE_MT = "mt";
    const DATABASE_GOOGLE_MU = "mu";
    const DATABASE_GOOGLE_MD = "md";
    const DATABASE_GOOGLE_MN = "mn";
    const DATABASE_GOOGLE_ME = "me";
    const DATABASE_GOOGLE_MA = "ma";
    const DATABASE_GOOGLE_MZ = "mz";
    const DATABASE_GOOGLE_NA = "na";
    const DATABASE_GOOGLE_NP = "np";
    const DATABASE_GOOGLE_NZ = "nz";
    const DATABASE_GOOGLE_NI = "ni";
    const DATABASE_GOOGLE_NG = "ng";
    const DATABASE_GOOGLE_OM = "om";
    const DATABASE_GOOGLE_PY = "py";
    const DATABASE_GOOGLE_PE = "pe";
    const DATABASE_GOOGLE_PH = "ph";
    const DATABASE_GOOGLE_PT = "pt";
    const DATABASE_GOOGLE_RO = "ro";
    const DATABASE_GOOGLE_SA = "sa";
    const DATABASE_GOOGLE_SN = "sn";
    const DATABASE_GOOGLE_RS = "rs";
    const DATABASE_GOOGLE_SK = "sk";
    const DATABASE_GOOGLE_SI = "si";
    const DATABASE_GOOGLE_ZA = "za";
    const DATABASE_GOOGLE_KR = "kr";
    const DATABASE_GOOGLE_LK = "lk";
    const DATABASE_GOOGLE_TH = "th";
    const DATABASE_GOOGLE_BS = "bs";
    const DATABASE_GOOGLE_TT = "tt";
    const DATABASE_GOOGLE_TN = "tn";
    const DATABASE_GOOGLE_UA = "ua";
    const DATABASE_GOOGLE_AE = "ae";
    const DATABASE_GOOGLE_UY = "uy";
    const DATABASE_GOOGLE_VE = "ve";
    const DATABASE_GOOGLE_VN = "vn";
    const DATABASE_GOOGLE_ZM = "zm";
    const DATABASE_GOOGLE_ZW = "zw";
    const DATABASE_GOOGLE_LY = "ly";
    const DATABASE_GOOGLE_PK = "pk";

    const DATABASE_MOBILE_UK = "mobile-uk";
    const DATABASE_MOBILE_CA = "mobile-ca";
    const DATABASE_MOBILE_DE = "mobile-de";
    const DATABASE_MOBILE_FR = "mobile-fr";
    const DATABASE_MOBILE_ES = "mobile-es";
    const DATABASE_MOBILE_IT = "mobile-it";
    const DATABASE_MOBILE_BR = "mobile-br";
    const DATABASE_MOBILE_AU = "mobile-au";
    const DATABASE_MOBILE_DK = "mobile-dk";
    const DATABASE_MOBILE_MX = "mobile-mx";
    const DATABASE_MOBILE_NL = "mobile-nl";
    const DATABASE_MOBILE_SE = "mobile-se";
    const DATABASE_MOBILE_TR = "mobile-tr";
    const DATABASE_MOBILE_IN = "mobile-in";
    const DATABASE_MOBILE_ID = "mobile-id";
    const DATABASE_MOBILE_IL = "mobile-il";

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