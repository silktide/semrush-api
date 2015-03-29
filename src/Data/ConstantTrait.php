<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi\Data;

use ReflectionClass;

trait ConstantTrait {

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