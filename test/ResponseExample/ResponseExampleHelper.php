<?php


namespace Silktide\SemRushApi\Test\ResponseExample;


abstract class ResponseExampleHelper {

    /**
     * Get an example response
     *
     * @param $name
     * @return string
     */
    static public function getResponseExample($name)
    {
        chdir(__DIR__);
        $filename = $name.".txt";
        return file_get_contents($filename);
    }
} 