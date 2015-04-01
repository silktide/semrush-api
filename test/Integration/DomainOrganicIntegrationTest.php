<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Row;

class DomainOrganicIntegrationTest extends AbstractIntegrationTest {

    public function testDomainAdwordsRequest()
    {
        $this->setupResponse('domain_organic_pistonheads');
        $result = $this->client->getDomainOrganic('argos.com', ['database' => Database::DATABASE_GOOGLE_US]);
        $this->verifyResult($result, 10);

        /**
         * @var Row $row
         */
        $row = $result[9];
        $this->assertEquals("http://www.pistonheads.com/classifieds/dealer/699778", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD_VISIBLE_URL));
    }
} 