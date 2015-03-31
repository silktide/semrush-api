# SEMrush API client

[![Build Status](https://travis-ci.org/silktide/semrush-api.svg?branch=master)](https://travis-ci.org/silktide/semrush-api)
[![Code Climate](https://codeclimate.com/github/silktide/semrush-api/badges/gpa.svg)](https://codeclimate.com/github/silktide/semrush-api)
[![Test Coverage](https://codeclimate.com/github/silktide/semrush-api/badges/coverage.svg)](https://codeclimate.com/github/silktide/semrush-api)

A PHP API client for the SEMrush API.

## Supported actions:

* domain_ranks
* domain_rank
* domain_rank_history

## Usage

### Installation

    composer require silktide/semrush-api
    composer update

### Setup

The API library was designed to use Dependency Injection (DI). It has a number of dependencies which need to be initialised and injected.  If you don't use DI, here's how to set up the API client:

    $requestFactory = new \Silktide\SemRushApi\Model\Factory\RequestFactory();
    $rowFactory = new \Silktide\SemRushApi\Model\Factory\RowFactory();
    $resultFactory = new \Silktide\SemRushApi\Model\Factory\ResultFactory($rowFactory);
    $guzzle = new \GuzzleHttp\Client();
    $key = "[YOUR API KEY]";
        
    $client = new \Silktide\SemRushApi\Client($key, $requestFactory, $resultFactory, $guzzle);
        
        
## Domain ranks

Getting the SEMrush "domain_ranks" for a website:

    $result = $this->client->getDomainRanks('silktide.com');
        
## Domain rank

Getting the SEMrush "domain_rank" for a website:

        $result = $this->client->getDomainRank(
            'silktide.com', 
            [
                'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
            ]
        );
        
## Domain rank history

Getting the SEMrush "domain_rank_history" for a website:

        $result = $this->client->getDomainRankHistory(
            'silktide.com', 
            [
                'database' => \Silktide\SemRushApi\Data\Database::DATABASE_GOOGLE_US
            ]
        );
        
## Using options

Here's an example of passing options to the domain ranks action in order to return a specific set of columns.

    $result = $this->client->getDomainRanks('silktide.com', [
        'export_columns' => [
            \Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_BUDGET,
            \Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_KEYWORDS,
            \Silktide\SemRushApi\Data\Column::COLUMN_OVERVIEW_ADWORDS_TRAFFIC
         ]
    ]);
