<?php

namespace AndyWaite\SemRushApi\Model;

use AndyWaite\SemRushApi\Data\Field;
use AndyWaite\SemRushApi\Model\Exception\InvalidDataException;
use AndyWaite\SemRushApi\Model\Exception\InvalidFieldException;

class Row {

    /**
     * @var string[]
     */
    protected $data = [];

    /**
     * Get all the data for this row
     *
     * @return string[]
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data for this row
     *
     * @param string[] $data
     * @throws InvalidDataException
     */
    public function setData($data)
    {
        if (!is_array($data)) {
            throw new InvalidDataException('The data provided was not an array.');
        }
        $this->validate($data);
        $this->data = $data;
    }

    /**
     * Get a single value from this row
     *
     * @param $key
     * @return string
     */
    public function getValue($key)
    {
        return $this->data[$key];
    }

    /**
     * Validate the data is correct
     *
     * @param string[] $data
     * @throws InvalidFieldException
     */
    protected function validate($data)
    {
        $field = new Field();
        foreach ($data as $code => $item) {
            if (!$field->isValidField($code)) {
                throw new InvalidFieldException("Tbe data provided was not a valid field code.");
            }
        }
    }
}