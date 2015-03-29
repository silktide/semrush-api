<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi;

use AndyWaite\SemRushApi\Model\Result;
use AndyWaite\SemRushApi\Model\Row;

class ResultFactory {

    /**
     * Takes raw API data and converts into a result
     *
     * @param string[] $columns
     * @param string $data
     * @return Result
     */
    public function create($columns, $data)
    {
        $result = new Result();
        $result->setRows($this->dataToRows($columns, $data));
        return $result;
    }

    /**
     * Convert raw API response into rows
     *
     * @param string[] $columns
     * @param string $data
     * @return Row[]
     */
    protected function dataToRows($columns, $data)
    {
        $rowFactory = new RowFactory();
        $rows = explode("\n", $data);
        unset($rows[0]);
        $return = [];
        foreach ($rows as $row) {
            $return[] = $rowFactory->create($columns, $row);
        }
        return $return;
    }

} 