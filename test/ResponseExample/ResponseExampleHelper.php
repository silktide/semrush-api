<?php


namespace AndyWaite\SemRushApi\Test\ResponseExample;


class ResponseExampleHelper {

    /**
     * Get an example response
     *
     * @param $name
     * @return string
     */
    public function getResponseExample($name)
    {
        chdir(__DIR__);
        $filename = $name.".txt";
        return file_get_contents($filename);
    }
} 