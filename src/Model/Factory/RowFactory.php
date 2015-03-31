<?php


namespace Silktide\SemRushApi\Model\Factory;

use Silktide\SemRushApi\Model\Exception\UnexpectedResponseException;
use Silktide\SemRushApi\Model\Row;

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

    /**
     * @param string[] $columns
     * @param string $data
     * @return string[]
     */
    protected function createAssociativeFromColumnsAndData($columns, $data)
    {
        $values = $this->stripQuotes($this->semicolonSeparatedToArray($data));

        $columnCount = count($columns);
        $valueCount = count($values);

        if ($columnCount != $valueCount)
        {
            throw new UnexpectedResponseException("The number of columns in the response [{$valueCount}] was not the same as the number of expected columns [{$columnCount}].");
        }

        return array_combine($columns, $values);
    }

    /**
     * Strip quotes from items in data array
     *
     * @param $data
     */
    protected function stripQuotes($data)
    {
        foreach ($data as &$item) {
            $item = trim($item,'"');
        }
        return $data;
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