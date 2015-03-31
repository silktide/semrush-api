<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Guzzle\Http\Message\Response;

class DomainAdwordsUniqueIntegrationTest extends AbstractIntegrationTest {

    public function testDomainAdwordsUniqueRequest()
    {
        $this->setupResponse('domain_adwords_unique_bbc');
        $result = $this->client->getDomainAdwordsUnique('bbc.co.uk', ['database' => Database::DATABASE_GOOGLE_US]);
        $this->verifyResult($result, 2);

        /**
         * @var Row $row
         */
        $row = $result[1];
        $this->assertEquals("Internet News‎", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD_AD_TITLE));
        $this->assertEquals("Breaking International <b>News</b>! Read Today's Latest Headlines Now", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD_AD_TEXT));
        $this->assertEquals("news.bbc.co.uk/", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD_VISIBLE_URL));
        $this->assertEquals("http://www.bbc.co.uk/news/", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD_TARGET_URL));
        $this->assertEquals("1", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD_NUMBER));
    }
} 