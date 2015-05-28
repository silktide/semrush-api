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
     * @param string $endpoint_path
     * @return Request
     */
    public function create($type, $options, $endpoint_path)
    {
        return new Request($type, $options, $endpoint_path);
    }

} 