<?php
$autoloader = realpath(dirname(__FILE__)) . '/vendor/autoload.php';
require_once($autoloader);

use \Silktide\SemRushApi\Data\Database;

$apiKey = "";

$logger = new \Monolog\Logger(new \Monolog\Handler\StreamHandler(STDOUT));
$client = \Silktide\SemRushApi\ClientFactory::create($apiKey);

$domainRank = $client->getDomainRankHistory("www.walktall.co.uk", [
    "database" => Database::DATABASE_GOOGLE_UK
])->getRows();

print_r($domainRank);