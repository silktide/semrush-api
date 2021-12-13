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
    public static function create(string $apiKey)
    {
        return Client::create($apiKey);
    }
}
