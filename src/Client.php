<?php

namespace Silktide\SemRushApi;

use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use Psr\SimpleCache\CacheInterface;
use Silktide\Capiture\ApiNames;
use Silktide\Capiture\ApiUsageTracker;
use Silktide\SemRushApi\Data\Type;
use Silktide\SemRushApi\Helper\ResponseParser;
use Silktide\SemRushApi\Helper\UrlBuilder;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Model\Factory\RowFactory;
use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result as ApiResult;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Log\LoggerAwareTrait;
use Exception;
use Silktide\SemRushApi\Model\Result;

class Client
{
    use LoggerAwareTrait;
    use ApiUsageTracker;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var ResponseParser
     */
    protected $responseParser;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var UrlBuilder
     */
    protected $urlBuilder;

    /**
     * @var GuzzleClient
     */
    protected $guzzle;

    /**
     * @var int
     */
    protected $connectTimeout = 15;

    /**
     * @var
     */
    protected $timeout = 15;

    /**
     * @var CacheInterface|null
     */
    protected $cache;

    /**
     * @var \DateInterval|null
     */
    protected $cacheLifetime;

    /**
     * @var string
     */
    protected $cachePrefix = "";

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
    public function __construct($apiKey, RequestFactory $requestFactory, ResponseParser $responseParser, ResultFactory $resultFactory, UrlBuilder $urlBuilder, GuzzleClient $guzzle)
    {
        $this->apiKey = $apiKey;
        $this->requestFactory = $requestFactory;
        $this->responseParser = $responseParser;
        $this->resultFactory = $resultFactory;
        $this->urlBuilder = $urlBuilder;
        $this->guzzle = $guzzle;
    }

    /**
     * @param CacheInterface $cache
     * @param \DateInterval $cacheLifetime
     * @param string $cachePrefix
     */
    public function setCache(CacheInterface $cache, \DateInterval $cacheLifetime = null, string $cachePrefix = "")
    {
        $this->cache = $cache;
        if ($cacheLifetime === null) {
            $cacheLifetime = new \DateInterval("P30D");
        }
        $this->cacheLifetime = $cacheLifetime;
        $this->cachePrefix = $cachePrefix;
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
     * @param string $phrase
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
     * @param string $domain
     * @param array $options
     * @return ApiResult
     */
    public function getPhraseThis($phrase, $options = [])
    {
        return $this->makeRequest(Type::TYPE_PHRASE_THIS, ['phrase' => $phrase] + $options);
    }

    /**
     * @param $type
     * @param $options
     * @return ApiResult
     * @throws Exception
     */
    protected function makeRequest($type, $options)
    {
        $request = $this->requestFactory->create($type, ['key' => $this->apiKey] + $options);
        try {

            $rawResponse = $this->makeHttpRequest($request);
            $formattedResponse = $this->responseParser->parseResult($request, $rawResponse);
            $response = $this->resultFactory->create($formattedResponse);
            $this->trackApiUsage(ApiNames::SEMRUSH, $request->getEndpoint(), true, [
                'usage' => $this->getApiUsage($request, $response)
            ]);
            return $response;
        } catch (BadResponseException $e) {
            $this->trackApiUsage(ApiNames::SEMRUSH, $request->getEndpoint(), false);
            throw $this->parseBadResponse($e);
        }
    }


    /**
     * Calculates how many API credits are used.
     *
     * @param Request $request
     * @param Result $response
     * @return int
     */
    public function getApiUsage($request, $response): int
    {
        $usage = 1;
        $options = $request->buildOptionsArray($request->getUrlParameters());

        $type = $options['type'];

        $historicRequest = array_key_exists('display_date', $options);

        switch ($type) {
            case Type::TYPE_DOMAIN_RANK:
            case Type::TYPE_DOMAIN_RANKS:
            case Type::TYPE_DOMAIN_ORGANIC:
                $usage = ($historicRequest ? 50 : 10);
                break;
            case Type::TYPE_DOMAIN_RANK_HISTORY:
            case Type::TYPE_ADVERTISER_RANK:
                $usage = 10;
                break;
            case Type::TYPE_DOMAIN_ADWORDS:
                $usage = ($historicRequest ? 100 : 20);
                break;
            case Type::TYPE_DOMAIN_PLA_SEARCH_KEYWORDS:
                $usage = ($historicRequest ? 150 : 30);
                break;
            case Type::TYPE_DOMAIN_ADWORDS_UNIQUE:
                $usage = 40;
                break;
            case Type::TYPE_KEYWORD_DIFFICULTY:
                $usage = 50;
                break;
            case Type::TYPE_ADVERTISER_PUBLISHERS:
            case Type::TYPE_ADVERTISER_DISPLAY_ADS:
                $usage = 100;
                break;
        }

        // Semrush charge per row returned.
        return $usage * $response->count();
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

        $cacheKey = $this->cachePrefix . md5($url);
        if ($this->cache) {
            if (!is_null($value = $this->cache->get($cacheKey))) {
                return $value;
            }
        }

        $guzzleResponse = $this->guzzle->request('GET', $url, [
            RequestOptions::CONNECT_TIMEOUT => $this->connectTimeout,
            RequestOptions::TIMEOUT => $this->timeout
        ]);

        $value = $guzzleResponse->getBody()->getContents();

        if ($this->cache) {
            $this->cache->set($cacheKey, $value, $this->cacheLifetime);
        }

        return $value;
    }

    /**
     * @param BadResponseException $e
     * @return \Exception
     */
    protected function parseBadResponse(BadResponseException $e)
    {
        $response = $e->getResponse();
        $message = (string)$response->getBody();

        if (!is_null($this->logger)) {
            $this->logger->error("[SemRush API] " . $message, [
                "StatusCode" => $response->getStatusCode(),
                "URL" => (string)$e->getRequest()->getUri()
            ]);
        }

        return new \Exception("[SemRush API] " . $message);
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

    public static function create(string $apiKey): Client
    {
        return new Client(
            $apiKey,
            new RequestFactory(),
            new ResponseParser(),
            new ResultFactory(
                new RowFactory()
            ),
            new UrlBuilder(),
            new GuzzleClient()
        );
    }
}
