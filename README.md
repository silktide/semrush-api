# SEMrush API client

[![Build Status](https://travis-ci.org/andywaite/semrush-api.svg?branch=master)](https://travis-ci.org/andywaite/semrush-api)
[![Code Climate](https://codeclimate.com/github/andywaite/semrush-api/badges/gpa.svg)](https://codeclimate.com/github/andywaite/semrush-api)
[![Test Coverage](https://codeclimate.com/github/andywaite/semrush-api/badges/coverage.svg)](https://codeclimate.com/github/andywaite/semrush-api)

A PHP API client for the SEMrush API.

## Supported actions:

* domain_ranks

## Usage

### Setup

Here's how to instantiate an API Client:

        $requestFactory = new \AndyWaite\SemRushApi\Model\Factory\RequestFactory();
        $rowFactory = new \AndyWaite\SemRushApi\Model\Factory\RowFactory();
        $resultFactory = new \AndyWaite\SemRushApi\Model\Factory\ResultFactory($rowFactory);
        $guzzle = new \GuzzleHttp\Client();        
        $client = new \AndyWaite\SemRushApi\Client("[YOUR API KEY]", $requestFactory, $resultFactory, $guzzle);
        
        
## Domain ranks

Getting the SEMrush "domain ranks" for a website:

        $result = $this->client->getDomainRanks('andywaite.me');
        
## Using options

Here's an example of passing options to the domain ranks action in order to return a specific set of columns.

        $result = $this->client->getDomainRanks('andywaite.me'. [
            'export_columns' => [
                \AndyWaite\SemRushApi\Data\Column::COLUMN_ADWORDS_BUDGET,
                \AndyWaite\SemRushApi\Data\Column::COLUMN_ADWORDS_KEYWORDS,
                \AndyWaite\SemRushApi\Data\Column::COLUMN_ADWORDS_TRAFFIC
             ]
        ]);