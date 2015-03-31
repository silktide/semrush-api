<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Guzzle\Http\Message\Response;

class DomainRankIntegrationTest extends AbstractIntegrationTest {

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
} 