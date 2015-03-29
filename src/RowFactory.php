<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi;

use AndyWaite\SemRushApi\Model\Row;

class RowFactory {

    /**
     * Takes raw API data and converts into a result
     *
     * @param string[] $columns
     * @param string $data
     * @return Row
     */
    public function create($columns, $data)
    {
        $row = new Row();
        $row->setData($this->createAssociativeFromColumnsAndData($columns, $data));
        return $row;
    }

    protected function createAssociativeFromColumnsAndData($columns, $data)
    {
        $values = $this->semicolonSeparatedToArray($data);
        return array_combine($columns, $values);
    }

    /**
     * Convert semicolon separated to array
     *
     * @param string $data
     * @return string[]
     */
    protected function semicolonSeparatedToArray($data)
    {
        return explode(";", $data);
    }
} 