<?php


namespace AndyWaite\SemRushApi\Model\Factory;

use AndyWaite\SemRushApi\Model\Request;

class RequestFactory {

    /**
     * Get a request
     *
     * @return Request
     */
    public function create($type, $options)
    {
        return new Request($type, $options);
    }

} 