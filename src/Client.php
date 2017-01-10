<?php

namespace Silktide\SemRushApi;

use Guzzle\Http\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Silktide\SemRushApi\Cache\CacheInterface;
use Silktide\SemRushApi\Data\Type;
use Silktide\SemRushApi\Helper\ResponseParser;
use Silktide\SemRushApi\Helper\UrlBuilder;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result as ApiResult;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Log\LoggerAwareTrait;
use Exception;

class Client
{
    use LoggerAwareTrait;

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
     * @var ResponseParser
     */
    protected $responseParser;

    /**
     * @var UrlBuilder
     */
    protected $urlBuilder;

    /**
     * @var GuzzleClient
     */
    protected $guzzle;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var int
     */
    protected $connectTimeout = 15;

    /**
     * @var
     */
    protected $timeout = 15;


    /**
     * Construct a client with API key
     *
     * @param string $apiKey
     * @param RequestFactory $requestFactory
     * @param ResultFactory $resultFactory
     * @param ResponseParser $responseParser
     * @param UrlBuilder $urlBuilder
     * @param GuzzleClient $guzzle
     */
    public function __construct($apiKey, RequestFactory $requestFactory, ResultFactory $resultFactory, ResponseParser $responseParser, UrlBuilder $urlBuilder, GuzzleClient $guzzle)
    {
        $this->apiKey = $apiKey;
        $this->requestFactory = $requestFactory;
        $this->resultFactory = $resultFactory;
        $this->responseParser = $responseParser;
        $this->urlBuilder = $urlBuilder;
        $this->guzzle = $guzzle;
    }

    /**
     * @return int
     */
    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    /**
     * @param int $connectTimeout
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->connectTimeout = $connectTimeout;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }


    /**
     * @param CacheInterface $cache
     */
    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
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
    public function getDomainPlaSearchKeywords($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_PLA_SEARCH_KEYWORDS, ['domain' => $domain] + $options);
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getDomainOrganic($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_ORGANIC, ['domain' => $domain] + $options);
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getDomainAdwords($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_ADWORDS, ['domain' => $domain] + $options);
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getDomainAdwordsUnique($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_DOMAIN_ADWORDS_UNIQUE, ['domain' => $domain] + $options);
    }

    /**
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getKeywordDifficulty($phrase, $options = [])
    {
        return $this->makeRequest(Type::TYPE_KEYWORD_DIFFICULTY, ['phrase' => $phrase] + $options);
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
     * @param $domain
     * @param array $options
     * @return ApiResult
     */
    public function getAdvertiserPublishers($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_ADVERTISER_PUBLISHERS, ['domain' => $domain] + $options);
    }

    /**
     * @param $domain
     * @param array $options
     * @return ApiResult
     */
    public function getAdvertiserDisplayAds($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_ADVERTISER_DISPLAY_ADS, ['domain' => $domain] + $options);
    }

    /**
     * @param $domain
     * @param array $options
     * @return ApiResult
     */
    public function getAdvertiserRank($domain, $options = [])
    {
        return $this->makeRequest(Type::TYPE_ADVERTISER_RANK, ['domain' => $domain] + $options);
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
        try {
            $request = $this->requestFactory->create($type, ['key' => $this->apiKey] + $options);

            // Attempt load from cache
            if (isset($this->cache)) {
                $result = $this->cache->fetch($request);
            }

            // Make request if not in cache
            if (!isset($result)) {
                $rawResponse = $this->makeHttpRequest($request);
                $formattedResponse = $this->responseParser->parseResult($request, $rawResponse);
                $result = $this->resultFactory->create($formattedResponse);
            }

            // Save to cache
            if (isset($this->cache)) {
                $this->cache->cache($request, $result);
            }

            return $result;

        } catch (BadResponseException $e) {
            $this->logBadResponse($e);
        } catch (Exception $e) {
            $this->logException($e);
        }

        return $this->resultFactory->create([]);
    }

    /**
     * Use guzzle to make request to API
     *
     * @param Request $request
     * @return string
     */
    protected function makeHttpRequest($request)
    {
        $url = $this->urlBuilder->build($request);
        $guzzleResponse = $this->guzzle->request('GET', $url, [
            RequestOptions::CONNECT_TIMEOUT => $this->connectTimeout,
            RequestOptions::TIMEOUT => $this->timeout
        ]);
        return $guzzleResponse->getBody();
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Log an exception being thrown
     *
     * @param \Exception $e
     */
    protected function logException(\Exception $e)
    {
        if (!is_null($this->logger)) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * @param BadResponseException $e
     */
    protected function logBadResponse(BadResponseException $e)
    {
        if (!is_null($this->logger)) {
            /*
             * A typical bad response looks something like this:
             * Server response error
             * [status code] 500
             * [message] An error occured
             * [url] https://spyfu.com/blah/blah/blah
             *
             * This regex allows us to parse out anything in square brackets and just after them, allowing us to put
             * them in an array like ["message" => "An error occured"]
             *
             * This means we can then add them as context rather than as the error message
             */
            $regex = "/\[(.*)\][ *]?(.*)/";
            preg_match_all($regex, $e->getMessage(), $matches);
            $message = trim(preg_replace($regex, "", $e->getMessage()));
            $context = [];
            for ($x=0; $x<count($matches[1]); $x++) {
                $context[$matches[1][$x]] = $matches[2][$x];
            }
            $this->logger->error("[SEMrush API] ".$message, $context);
        }
    }

}
