<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Guzzle\Http\Message\Response;

class DomainRankHistoryIntegrationTest extends AbstractIntegrationTest {

    public function testDomainRankHistoryRequest()
    {
        $this->guzzlePlugin->addResponse(new Response(200, null, ResponseExampleHelper::getResponseExample('domain_rank_history_ebay')));
        $result = $this->client->getDomainRankHistory('ebay.com', ['database' => Database::DATABASE_GOOGLE_US]);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(10, count($result));
        foreach ($result as $row) {
            $this->assertTrue($row instanceof Row);
        }

        /**
         * @var Row $row
         */
        $row = $result[1];
        $this->assertEquals(779171, $row->getValue(Column::COLUMN_OVERVIEW_ADWORDS_TRAFFIC));
    }
} 