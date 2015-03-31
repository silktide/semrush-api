<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace Silktide\SemRushApi\Helper;


use Silktide\SemRushApi\Helper\Exception\ResponseException;

class ResponseParser {

    /**
     * Parse a result into an array
     *
     * @param $data
     * @throws ResponseException
     * @return string[]
     */
    public function parseResult($columns, $data)
    {
        if ($this->isError($data))
        {
            throw new ResponseException("The API returned an error [{$data}]");
        }
        $rows = $this->splitStringIntoArray($data);
        foreach ($rows as &$row) {
            $row = $this->parseRow($columns, $row);
        }
        return $rows;
    }

    /**
     * @param $data
     * @return bool
     */
    protected function isError($data)
    {
        return preg_match("/^ERROR .*$/", $data) ? true : false;
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
     * @param string $data
     * @return string[]
     */
    protected function parseRow($columns, $data)
    {
        $asArray = $this->semicolonSeparatedToArray($data);
        return array_combine($columns, $this->stripQuotes($asArray));
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