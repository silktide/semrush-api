<?php


namespace Silktide\SemRushApi;

use Silktide\SemRushApi\Data\Type;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result as ApiResult;
use Guzzle\Http\Client as GuzzleClient;

class Client {

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var GuzzleClient
     */
    protected $guzzle;

    /**
     * Construct a client with API key
     *
     * @param string $apiKey
     * @param RequestFactory $requestFactory
     * @param ResultFactory $resultFactory
     * @param GuzzleClient $guzzle
     */
    public function __construct($apiKey, RequestFactory $requestFactory, ResultFactory $resultFactory, GuzzleClient $guzzle)
    {
        $this->apiKey = $apiKey;
        $this->requestFactory = $requestFactory;
        $this->resultFactory = $resultFactory;
        $this->guzzle = $guzzle;
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getDomainRanks($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_RANKS, ['domain' => $domain] + $options);
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getDomainRank($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_RANK, ['domain' => $domain] + $options);
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getDomainRankHistory($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_RANK_HISTORY, ['domain' => $domain] + $options);
    }

    /**
     * Make the request
     *
     * @param string $type
     * @param array $options
     * @return ApiResult
     */
    protected function makeRequest($type, $options)
    {
        $request = $this->requestFactory->create($type,  ['key' => $this->apiKey] + $options);
        return $this->resultFactory->create($request->getExpectedResultColumns(), $this->makeHttpRequest($request));
    }

    /**
     * Use guzzle to make request to API
     *
     * @param Request $request
     * @return string
     */
    protected function makeHttpRequest($request)
    {
        $guzzleRequest = $this->guzzle->createRequest('GET', $request->getUrl());
        $guzzleResponse = $this->guzzle->send($guzzleRequest);
        return $guzzleResponse->getBody();
    }

} 