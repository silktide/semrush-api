<?php

namespace Silktide\SemRushApi;

use Guzzle\Http\Client as Guzzle;
use Silktide\SemRushApi\Helper\ResponseParser;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Model\Factory\RowFactory;

abstract class ClientFactory
{

    /**
     * Create an instance of Client with default dependencies
     * automatically created (for use by people without DI)
     *
     * @param string $apiKey
     * @return Client
     */
    static public function create($apiKey)
    {
        $requestFactory = new RequestFactory();
        $rowFactory = new RowFactory();
        $resultFactory = new ResultFactory($rowFactory);
        $responseParser = new ResponseParser();
        $guzzle = new Guzzle();

        return new Client($apiKey, $requestFactory, $resultFactory, $responseParser, $guzzle);
    }

} 