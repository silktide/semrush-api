<?php

namespace Silktide\SemRushApi\Helper;

use Silktide\SemRushApi\Helper\Exception\EmptyResponseException;
use Silktide\SemRushApi\Helper\Exception\ErroneousResponseException;
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
     * @throws ErroneousResponseException
     * @return string[]
     */
    public function parseResult(Request $request, $data)
    {
        try {
            $this->handleErrors($data);
        } catch (EmptyResponseException $e) {
            return [];
        }

        $rows = $this->splitStringIntoArray($data);
        foreach ($rows as &$row) {
            $row = $this->parseRow($request->getExpectedResultColumns(), $row);
        }

        return $rows;
    }

    /**
     * @param $data
     * @throws EmptyResponseException
     * @throws ErroneousResponseException
     */
    protected function handleErrors($data)
    {
        if ($this->isEmpty($data)) {
            throw new EmptyResponseException("The API has no data for this request.");
        }

        if ($this->isError($data)) {
            throw new ErroneousResponseException("The API returned an error [{$data}]");
        }
    }

    /**
     * Check if this response was empty
     *
     * @param string $data
     * @return bool
     */
    protected function isEmpty($data)
    {
        return $data == "ERROR 50 :: NOTHING FOUND";
    }

    /**
     * Check if this response was an error
     *
     * @param string $data
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
        return array_combine($columns, str_getcsv($data, ";"));
    }

} 