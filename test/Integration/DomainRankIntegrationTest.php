<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Guzzle\Http\Message\Response;

class DomainRankIntegrationTest extends AbstractIntegrationTest {

    public function testDomainRankRequest()
    {
        $this->setupResponse('domain_rank_amazon');
        $result = $this->client->getDomainRank('amazon.com', ['database' => Database::DATABASE_GOOGLE_US]);
        $this->verifyResult($result, 1);

        /**
         * @var Row $row
         */
        $row = $result[0];
        self::assertEquals(22177894, $row->getValue(Column::COLUMN_OVERVIEW_ADWORDS_TRAFFIC));
    }
} 