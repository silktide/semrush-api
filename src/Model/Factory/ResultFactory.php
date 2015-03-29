<?php


namespace AndyWaite\SemRushApi\Model\Factory;

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
     * Splits string data into array of row strings and breaks off header row
     *
     * @param string $data
     * @return string[]
     */
    protected function splitStringIntoArray($data)
    {
        $rows = explode("\n", $data);
        unset($rows[0]);
        return $rows;
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
        $rows = $this->splitStringIntoArray($data);
        $return = [];
        foreach ($rows as $row) {
            $return[] = $rowFactory->create($columns, $row);
        }
        return $return;
    }

} 