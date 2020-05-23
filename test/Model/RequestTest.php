<?php


namespace Silktide\SemRushApi\Test\Model;

use Silktide\SemRushApi\Data\Column;
use Silktide\SemRushApi\Data\Database;
use Silktide\SemRushApi\Data\Type;
use Silktide\SemRushApi\Model\Exception\InvalidOptionException;
use Silktide\SemRushApi\Model\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase {

    protected $key = 'testkey';
    protected $domain = 'domain.com';


    public function testGetExpectedResultColumns()
    {
        $columns = [
            Column::COLUMN_OVERVIEW_ADWORDS_BUDGET,
            Column::COLUMN_OVERVIEW_ADWORDS_KEYWORDS
        ];

        $request = new Request(Type::TYPE_DOMAIN_RANKS, [
            'key' => $this->key,
            'domain' => $this->domain,
            'export_columns' => $columns
        ]);

        self::assertEquals($columns, $request->getExpectedResultColumns());
    }

    public function testRequest()
    {
        $date = '20150115';
        $columns = [
            Column::COLUMN_OVERVIEW_ADWORDS_BUDGET,
            Column::COLUMN_OVERVIEW_ADWORDS_KEYWORDS
        ];

        $options = [
            'key' => $this->key,
            'domain' => $this->domain,
            'display_date' => $date,
            'database' => Database::DATABASE_GOOGLE_UK,
            'export_columns' => $columns,
            'display_limit' => 12
        ];

        $request = new Request(Type::TYPE_DOMAIN_RANK_HISTORY, $options);

        $options['type'] = Type::TYPE_DOMAIN_RANK_HISTORY;
        $options['export_escape'] = "1";

        self::assertEquals($options, $request->getUrlParameters());
    }

    public function testGetEndpoint()
    {
        $request = new Request(Type::TYPE_DOMAIN_RANKS, [
            'key' => $this->key,
            'domain' => $this->domain
        ]);
        self::assertEquals("http://api.semrush.com/", $request->getEndpoint());
        $request = new Request(Type::TYPE_ADVERTISER_RANK, [
            'key' => $this->key,
            'domain' => $this->domain
        ]);
        self::assertEquals("http://api.semrush.com/analytics/da/v2/", $request->getEndpoint());
    }


    public function testRequestWithMissingOption()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('Missing option(s) [key, domain] which are required for request [domain_ranks]');
        new Request(Type::TYPE_DOMAIN_RANKS, []);
    }

    public function testRequestWithInvalidColumnData()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('Invalid [export_columns](s) [Blah] passed for request [domain_ranks]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'export_columns' => ['Blah', 'At']]);
    }

    public function testRequestWithInvalidColumnValue()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[export_columns] is expected to be array for [domain_ranks]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'export_columns' => 'blah']);
    }

    public function testRequestWithInvalidOption()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('Invalid option(s) [something] passed for request [domain_ranks]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['something' => 'bad']);
    }

    public function testRequestWithInvalidDate()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[display_date] was not a valid date [20301215]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'display_date' => "20301215"]);
    }

    public function testRequestWithInvalidBoolean()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[export_escape] was not 1 or 0 [wrong]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'export_escape' => 'wrong']);
    }

    public function testRequestWithInvalidDomain()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[domain] was not a valid domain [not a domain]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => "not a domain"]);
    }

    public function testRequestWithInvalidInteger()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[display_limit] was not an integer [beep]');
        new Request(Type::TYPE_DOMAIN_RANK_HISTORY, ['key' => $this->key, 'domain' => $this->domain, 'display_limit' => "beep", 'database' => 'uk']);
    }

    public function testRequestWithInvalidDatabase()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[database] was not a database [rubbish]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => $this->key, 'domain' => $this->domain, 'database' => 'rubbish']);
    }

    public function testRequestWithInvalidKey()
    {
        $this->expectException(InvalidOptionException::class);
        $this->expectExceptionMessage('[key] was not a string [12]');
        new Request(Type::TYPE_DOMAIN_RANKS, ['key' => 12, 'domain' => $this->domain]);
    }

} 