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
        $columns = $request->getExpectedResultColumns();
        $rows = $this->hackToFixNewlineInCell($rows);

        foreach ($rows as &$row) {
            $row = $this->parseRow($columns, $row);
        }

        return $rows;
    }

    /**
     * Hack to fix unexpected newlines in response data
     *
     * @param string[] $rows
     * @return string[]
     */
    protected function hackToFixNewlineInCell($rows)
    {
        /**
         * Loop through rows.  If the number of quotes is odd, concatenate row with
         * next row(s) until the response contains the required number of quote marks.
         */
        foreach ($rows as $key => &$row)
        {
            $nextRowId = $key + 1;
            while (substr_count($row, '"') % 2 != 0 && isset($rows[$nextRowId])) {
                $row .= PHP_EOL.$rows[$nextRowId];
                unset($rows[$nextRowId]);
                $nextRowId++;
            }
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
     * @throws ErroneousResponseException
     * @return string[]
     */
    protected function parseRow($columns, $data)
    {
        $rows = str_getcsv($data, ";");
        $expectedColumnCount = count($columns);
        $actualColumnCount = count($rows);

        if ($expectedColumnCount != $actualColumnCount) {
            throw new ErroneousResponseException("Number of columns in row [{$actualColumnCount}] did not equal number of expected columns [{$expectedColumnCount}]");
        }

        return array_combine($columns, $rows);
    }

} 