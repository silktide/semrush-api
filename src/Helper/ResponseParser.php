<?php

namespace Silktide\SemRushApi\Helper;

use Silktide\SemRushApi\Helper\Exception\ResponseException;
use Silktide\SemRushApi\Model\Request;

class ResponseParser
{

    /**
     * Parse a result into an array.  Also requires
     * the request so we can work out which columns
     * we expected the API to return.
     *
     * @param Request $request
     * @param string $data
     * @throws ResponseException
     * @return string[]
     */
    public function parseResult(Request $request, $data)
    {
        if ($this->isError($data)) {
            throw new ResponseException("The API returned an error [{$data}]");
        }
        $rows = $this->splitStringIntoArray($data);
        foreach ($rows as &$row) {
            $row = $this->parseRow($request->getExpectedResultColumns(), $row);
        }
        return $rows;
    }

    /**
     * Check if this response was an error
     *
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
     * Parse a set of columns and data into an array
     *
     * @param array $columns
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
            $item = trim($item, '"');
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