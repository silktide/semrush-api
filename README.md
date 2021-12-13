# SEMrush API client

[![Build Status](https://travis-ci.org/silktide/semrush-api.svg?branch=master)](https://travis-ci.org/silktide/semrush-api)
[![Code Climate](https://codeclimate.com/github/silktide/semrush-api/badges/gpa.svg)](https://codeclimate.com/github/silktide/semrush-api)
[![Test Coverage](https://codeclimate.com/github/silktide/semrush-api/badges/coverage.svg)](https://codeclimate.com/github/silktide/semrush-api)

A PHP API client for the SEMrush API.

## Supported actions:

* domain_ranks
* domain_rank
* domain_rank_history
* domain_organic
* domain_adwords
* domain_adwords_unique
* advertiser_publishers
* advertiser_text_ads
* advertiser_rank
* phrase_this (https://www.semrush.com/api-analytics/#phrase_this)

## Usage

## Installation

```
    composer require silktide/semrush-api
```

## Setup

This library was designed to use Dependency Injection (DI). If you don't use DI, you could use the factory to set up the API client:

```php
    $client = \Silktide\SemRushApi\ClientFactory::create("[YOUR SEMRUSH API KEY]");
```

## Caching

The API library can use a PSR-16 style cache to reduce calls to the API.

```php
    $cache = new Psr16CompliantCache();
    $client->setCache($cache)
```

## API calls
        
### Domain ranks

Getting the SEMrush "domain_ranks" for a website:

```php
    $result = $client->getDomainRanks('silktide.com');
```
        
### Domain rank

Getting the SEMrush "domain_rank" for a website:

```php
    $result = $client->getDomainRank(
        'silktide.com',
        [
            'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
        ]
    );
```

### Domain rank history

Getting the SEMrush "domain_rank_history" for a website:

```php
    $result = $client->getDomainRankHistory(
        'silktide.com',
        [
            'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
        ]
    );
```
        
### Domain organic

Getting the SEMrush "domain_organic" for a website:

```php
    $result = $client->getDomainOrganic(
        'silktide.com',
        [
            'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
        ]
    );
```

### Domain adwords

Getting the SEMrush "domain_adwords" for a website:

```php
    $result = $client->getDomainAdwords(
        'silktide.com',
        [
            'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
        ]
    );
```
        
### Domain adwords unique

Getting the SEMrush "domain_adwords_unique" for a website:

```php
    $result = $client->getDomainAdwordsUnique(
        'silktide.com',
        [
            'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
        ]
    );
```

## Using options

Here's an example of passing options to the domain ranks action in order to return a specific set of columns.

```php
    $result = $client->getDomainRanks('silktide.com', [
        'export_columns' => [
            \Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_BUDGET,
            \Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_KEYWORDS,
            \Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_TRAFFIC
         ]
    ]);
```

## Using results

All API actions will return a `Result` object.  Result objects contain a number of `Row` objects and are iterable and
countable.  Here's a (non exhaustive) example of how they can be used. 

```php
    foreach ($result as $row) {
        $budget = $row->getValue(\Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_BUDGET);
        echo "\nThe AdWords spend of this site in the last month was an estimated ${$budget}";
    }
```
