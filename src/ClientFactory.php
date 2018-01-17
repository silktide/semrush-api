<?php

namespace Silktide\SemRushApi;

use GuzzleHttp\Client as GuzzleClient;
use Silktide\SemRushApi\Helper\ResponseParser;
use Silktide\SemRushApi\Helper\UrlBuilder;
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
    static public function create(string $apiKey)
    {
        $requestFactory = new RequestFactory();
        $rowFactory = new RowFactory();
        $resultFactory = new ResultFactory($rowFactory);
        $responseParser = new ResponseParser();
        $urlBuilder = new UrlBuilder();
        $guzzle = new GuzzleClient();
        return new Client($apiKey, $requestFactory, $responseParser, $resultFactory, $urlBuilder, $guzzle);
    }
}
