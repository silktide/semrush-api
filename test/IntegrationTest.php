<?php


namespace Silktide\SemRushApi;

use Silktide\SemRushApi\Client;
use Silktide\SemRushApi\Data\Column;
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

class IntegrationTest extends PHPUnit_Framework_TestCase {


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

        $this->guzzlePlugin = new MockPlugin();
        $guzzle = new GuzzleClient();
        $guzzle->addSubscriber($this->guzzlePlugin);

        $this->client = new Client("demokey", $requestFactory, $resultFactory, $guzzle);
    }

    public function testDomainRanksRequest()
    {
        $this->guzzlePlugin->addResponse(new Response(200, null, ResponseExampleHelper::getResponseExample('domain_ranks_silktide')));
        $result = $this->client->getDomainRanks('silktide.com');
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(26, count($result));
        foreach ($result as $row) {
            $this->assertTrue($row instanceof Row);
        }

        /**
         * @var Row $row
         */
        $row = $result[1];
        $this->assertEquals("silktide.com", $row->getValue(Column::COLUMN_DOMAIN));
        $this->assertEquals(94028, $row->getValue(Column::COLUMN_SEMRUSH_RATING));
    }

    public function testDomainRankRequest()
    {
        $this->guzzlePlugin->addResponse(new Response(200, null, ResponseExampleHelper::getResponseExample('domain_rank_amazon')));
        $result = $this->client->getDomainRank('amazon.com', ['database' => 'us']);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(1, count($result));
        foreach ($result as $row) {
            $this->assertTrue($row instanceof Row);
        }

        /**
         * @var Row $row
         */
        $row = $result[0];
        $this->assertEquals(22177894, $row->getValue(Column::COLUMN_ADWORDS_TRAFFIC));
    }

    public function testDomainRankHistoryRequest()
    {
        $this->guzzlePlugin->addResponse(new Response(200, null, ResponseExampleHelper::getResponseExample('domain_rank_history_ebay')));
        $result = $this->client->getDomainRankHistory('ebay.com', ['database' => 'us']);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(10, count($result));
        foreach ($result as $row) {
            $this->assertTrue($row instanceof Row);
        }

        /**
         * @var Row $row
         */
        $row = $result[1];
        $this->assertEquals(779171, $row->getValue(Column::COLUMN_ADWORDS_TRAFFIC));
    }
} 