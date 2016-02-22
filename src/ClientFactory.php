<?php

namespace Silktide\SemRushApi;

use GuzzleHttp\Client as Guzzle;
use Silktide\SemRushApi\Cache\MemoryCache;
use Silktide\SemRushApi\Helper\ResponseParser;
use Silktide\SemRushApi\Helper\UrlBuilder;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Model\Factory\RowFactory;
use Silktide\SemRushApi\Cache\CacheInterface;

abstract class ClientFactory
{

    /**
     * Create an instance of Client with default dependencies
     * automatically created (for use by people without DI)
     *
     * @param string $apiKey
     * @param CacheInterface $cache
     * @return Client
     */
    static public function create($apiKey, $cache = null)
    {
        $requestFactory = new RequestFactory();
        $rowFactory = new RowFactory();
        $resultFactory = new ResultFactory($rowFactory);
        $responseParser = new ResponseParser();
        $urlBuilder = new UrlBuilder();
        $guzzle = new Guzzle();

        $client = new Client($apiKey, $requestFactory, $resultFactory, $responseParser, $urlBuilder, $guzzle);

        if (isset($cache)) {
            $client->setCache($cache);
        }

        return $client;
    }

} 