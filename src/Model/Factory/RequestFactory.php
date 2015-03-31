<?php

namespace Silktide\SemRushApi\Model\Factory;

use Silktide\SemRushApi\Model\Request;

class RequestFactory
{

    /**
     * Get a request
     *
     * @param string $type
     * @param array $options
     * @return Request
     */
    public function create($type, $options)
    {
        return new Request($type, $options);
    }

} 