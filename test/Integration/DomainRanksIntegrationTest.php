<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Guzzle\Http\Message\Response;

class DomainRanksIntegrationTest extends AbstractIntegrationTest {

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
        $this->assertEquals("silktide.com", $row->getValue(Column::COLUMN_OVERVIEW_DOMAIN));
        $this->assertEquals(94028, $row->getValue(Column::COLUMN_OVERVIEW_SEMRUSH_RATING));
    }
} 