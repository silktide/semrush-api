<?php


namespace Silktide\SemRushApi\Data;

use ReflectionClass;

trait ConstantTrait
{

    /**
     * Return all the databases
     *
     * @return string[]
     */
    protected static function getConstants()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
} 