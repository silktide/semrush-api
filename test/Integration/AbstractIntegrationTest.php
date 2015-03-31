<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Client;
use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Helper\ResponseParser;
use Silktide\SemRushApi\Helper\UrlBuilder;
use Silktide\SemRushApi\Model\Factory\RequestFactory;
use Silktide\SemRushApi\Model\Factory\ResultFactory;
use Silktide\SemRushApi\Model\Factory\RowFactory;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as GuzzleClient;

abstract class AbstractIntegrationTest extends PHPUnit_Framework_TestCase {


    /**
     * @var Client
     */
    protected $client;

    /**
     * @var MockPlugin
     */
    protected $guzzlePlugin;

    public function setup()
    {
        $requestFactory = new RequestFactory();
        $rowFactory = new RowFactory();
        $resultFactory = new ResultFactory($rowFactory);
        $responseParser = new ResponseParser();
        $urlBuilder = new UrlBuilder();

        $this->guzzlePlugin = new MockPlugin();
        $guzzle = new GuzzleClient();
        $guzzle->addSubscriber($this->guzzlePlugin);

        $this->client = new Client("demokey", $requestFactory, $resultFactory, $responseParser, $urlBuilder, $guzzle);
    }
} 