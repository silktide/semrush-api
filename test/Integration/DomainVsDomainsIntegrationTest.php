<?php


namespace Silktide\SemRushApi\Test\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Row;
use Guzzle\Http\Message\Response;

class DomainVsDomainsIntegrationTest extends AbstractIntegrationTest {

    public function testDomainRankHistoryRequest()
    {
        $this->setupResponse('domain_domains');
        $result = $this->client->getDomainVsDomains(['nike.com', 'adidas.com'], ['reebok.com'], ['database' => Database::DATABASE_GOOGLE_US]);
        $this->verifyResult($result, 10);

        /**
         * @var Row $row
         */
        $row = $result[1];
        self::assertEquals(48, $row->getValue(Column::COLUMN_FIRST_DOMAIN));
        self::assertEquals(22, $row->getValue(Column::COLUMN_SECOND_DOMAIN));
        self::assertEquals(0, $row->getValue(Column::COLUMN_THIRD_DOMAIN));
    }
} 