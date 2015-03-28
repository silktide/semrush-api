<?php

namespace AndyWaite\SemRushApi\Model;

use AndyWaite\SemRushApi\Model\Exception\InvalidRowException;

class Result {

    /**
     * @var Row[]
     */
    protected $rows;

    /**
     * @return Row[]
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param Row[] $rows
     */
    public function setRows($rows)
    {
        $this->validateRows($rows);
        $this->rows = $rows;
    }

    /**
     * Validate a set of rows
     *
     * @param Row[] $rows
     * @throws InvalidRowException
     */
    protected function validateRows($rows)
    {
        if (!is_array($rows)) {
            throw new InvalidRowException("The rows provided were not an array.");
        }
        foreach ($rows as $row) {
            $this->validateRow($row);
        }
    }

    /**
     * Validate a row of data
     *
     * @param Row $row
     * @throws InvalidRowException
     */
    protected function validateRow(Row $row)
    {
        if (!($row instanceof Row)) {
            throw new InvalidRowException("The row provided was not a valid row object.");
        }
    }

}