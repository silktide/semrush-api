<?php


namespace Silktide\SemRushApi\Integration;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Model\Result;
use Silktide\SemRushApi\Model\Row;
use Silktide\SemRushApi\Test\ResponseExample\ResponseExampleHelper;
use Guzzle\Http\Message\Response;

class DomainAdwordsIntegrationTest extends AbstractIntegrationTest {

    public function testDomainAdwordsRequest()
    {
        $this->guzzlePlugin->addResponse(new Response(200, null, ResponseExampleHelper::getResponseExample('domain_adwords_argos')));
        $result = $this->client->getDomainAdwords('silktide.com', ['database' => Database::DATABASE_GOOGLE_US]);
        $this->assertTrue($result instanceof Result);
        $this->assertEquals(10, count($result));
        foreach ($result as $row) {
            $this->assertTrue($row instanceof Row);
        }

        /**
         * @var Row $row
         */
        $row = $result[9];
        $this->assertEquals("home framing software", $row->getValue(Column::COLUMN_DOMAIN_KEYWORD));
    }
} 