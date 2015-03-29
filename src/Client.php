<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi;


use AndyWaite\SemRushApi\Connector\ConnectorInterface;
use AndyWaite\SemRushApi\Connector\GuzzleConnector;
use AndyWaite\SemRushApi\Data\Database;
use AndyWaite\SemRushApi\Data\Type;
use AndyWaite\SemRushApi\Exception\InvalidDatabaseException;
use AndyWaite\SemRushApi\Exception\InvalidKeyException;
use AndyWaite\SemRushApi\Model\Result;
use AndyWaite\SemRushApi\Model\Factory\ResultFactory;

class Client {

    const API_ENDPOINT_NORMAL = "http://api.semrush.com/";

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var ConnectorInterface
     */
    protected $connector;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Construct with API key
     *
     * @param string $apiKey
     * @param ConnectorInterface $connector
     * @param ResultFactory $resultFactory
     */
    public function __construct($apiKey, ConnectorInterface $connector = null, ResultFactory $resultFactory = null)
    {
        if (!is_string($apiKey) || strlen($apiKey) == 0) {
            throw new InvalidKeyException("The key provided does not appear to be a valid string.");
        }
        $this->apiKey = $apiKey;

        if (!isset($connector)) {
            $connector = new GuzzleConnector();
        }

        $this->connector = $connector;

        if (!isset($resultFactory)) {
            $resultFactory = new ResultFactory();
        }
        $this->resultFactory = $resultFactory;
    }

    /**
     * Implode the columns into a string the API can understand
     *
     * @param string[] $columns
     * @return string
     */
    protected function implodeColumns($columns)
    {
        return implode(",", $columns);
    }


    /**
     * @param string $domain
     * @param string $database
     * @param string[]|null $columns
     * @param string|null $date
     * @return Result
     */
    public function getDomainRanks($domain, $database = null, $columns = null, $date = null)
    {
        $type = Type::TYPE_DOMAIN_RANKS;

        if (!isset($columns)) {
            $columns = Type::getDefaultColumns($type);
        }

        $arguments = [
            'domain' => $domain
        ];

        if (isset($database)) {
            if (!in_array($database, Database::getDatabases())) {
                throw new InvalidDatabaseException("[{$database}] is not a valid database.");
            }
            $arguments['database'] = $database;
        }

        return $this->makeRequest($type, $columns, $arguments);
    }

    /**
     * @param array $parameters
     * @return Result
     */
    protected function makeRequest($type, $columns, $parameters)
    {
        $parameters['export_columns'] = $this->implodeColumns($columns);
        $parameters['export_escape'] = 1;
        $parameters['type'] = $type;
        $url = self::API_ENDPOINT_NORMAL.'?'.http_build_query($parameters);
        return $this->resultFactory->create($columns, $this->connector->get($url));
    }


} 