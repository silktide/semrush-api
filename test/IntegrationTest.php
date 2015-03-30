<?php


namespace AndyWaite\SemRushApi;

use AndyWaite\SemRushApi\Client;
use AndyWaite\SemRushApi\Data\Column;
use AndyWaite\SemRushApi\Model\Factory\RequestFactory;
use AndyWaite\SemRushApi\Model\Factory\ResultFactory;
use AndyWaite\SemRushApi\Model\Factory\RowFactory;
use AndyWaite\SemRushApi\Model\Result;
use AndyWaite\SemRushApi\Model\Row;
use AndyWaite\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use PHPUnit_Framework_TestCase;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Client as GuzzleClient;

class IntegrationTest extends PHPUnit_Framework_TestCase {

    public function testDomainRanksRequest()
    {
        $requestFactory = new RequestFactory();
        $rowFactory = new RowFactory();
        $resultFactory = new ResultFactory($rowFactory);

        $plugin = new MockPlugin();
        $plugin->addResponse(new Response(200, null, ResponseExampleHelper::getResponseExample('domain_ranks_default')));
        $guzzle = new GuzzleClient();
        $guzzle->addSubscriber($plugin);

        $client= new Client("demokey", $requestFactory, $resultFactory, $guzzle);
        $result = $client->getDomainRanks('andywaite.me');
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(2, count($result));
        foreach ($result as $row) {
            $this->assertTrue($row instanceof Row);
        }

        /**
         * @var Row $row
         */
        $row = $result[1];
        $this->assertEquals(32, $row->getValue(Column::COLUMN_ADWORDS_TRAFFIC));
    }
} 