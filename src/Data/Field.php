<?php
/**
 * Copyright 2013-2015 Silktide Ltd. All Rights Reserved.
 */

namespace AndyWaite\SemRushApi\Data;

use AndyWaite\SemRushApi\Data\Exception\InvalidFieldException;

class Field
{

    private $fields = [
        "Ab" =>
            [
                "description" => "The place on the SERP where the ad appeared (top, side, bottom blocks)."
            ],
        "Ac" =>
            [
                "description" => "Estimated budget spent buying keywords in Google AdWords for ads that appear in paid search results (monthly estimation)."
            ],
        "Ad" =>
            [
                "description" => "Keywords the website is buying in Google AdWords for ads that appear in paid search results."
            ],
        "Am" =>
            [
                "description" => "Number of adwords keywords changes"
            ],
        "At" =>
            [
                "description" => "Traffic brought to the website via Google AdWords paid search results."
            ],
        "Bm" =>
            [
                "description" => "Adwords traffic changes"
            ],
        "Cm" =>
            [
                "description" => "Adwords traffic price changes"
            ],
        "Co" =>
            [
                "description" => "Competitive density of advertisers using the given term for their ads. One (1) means the highest competition."
            ],
        "Cp" =>
            [
                "description" => "Average price in U.S. dollars advertisers pay for a user’s click on an ad containing the given keyword (Google AdWords)."
            ],
        "Cr" =>
            [
                "description" => "Competition level based on keywords"
            ],
        "Cv" =>
            [
                "description" => "Keyword coverage represents the percentage of ads displayed for a particular keyword in the last 12 months (100% = 12 months)."
            ],
        "Db" =>
            [
                "description" => "Database"
            ],
        "Dn" =>
            [
                "description" => "The website ranking in Google's top 20 organic search results. Click the sign with a small arrow to view the website, or click the link to open the Overview Report for the domain."
            ],
        "Ds" =>
            [
                "description" => "Ad text"
            ],
        "Dt" =>
            [
                "description" => "Actual date"
            ],
        "Hs" =>
            [
                "description" => "Whether the report is historical?"
            ],
        "Ip" =>
            [
                "description" => "IP address"
            ],
        "Lc" =>
            [
                "description" => "API units per line"
            ],
        "Li" =>
            [
                "description" => "Limit"
            ],
        "Np" =>
            [
                "description" => "The same keywords the given and queried domains are ranking for in Google's top 20 organic search results."
            ],
        "Nq" =>
            [
                "description" => "The average number of search queries for the given keyword for the last 12 months."
            ],
        "Nr" =>
            [
                "description" => "The number of URLs displayed in organic search results for the given keyword."
            ],
        "Oc" =>
            [
                "description" => "Estimated price of organic keywords in Google AdWords."
            ],
        "Of" =>
            [
                "description" => "Offset"
            ],
        "Om" =>
            [
                "description" => "Number of organic keywords changes"
            ],
        "Or" =>
            [
                "description" => "Keywords bringing users to the website via Google's top 20 organic search results."
            ],
        "Ot" =>
            [
                "description" => "Traffic brought to the website via Google's top 20 organic search results."
            ],
        "P0" =>
            [
                "description" => "The position of first domain for this keyword in organic or Ads results"
            ],
        "P1" =>
            [
                "description" => "The position of second domain for this keyword in organic or Ads results"
            ],
        "P2" =>
            [
                "description" => "The position of third domain for this keyword in organic or Ads results"
            ],
        "P3" =>
            [
                "description" => "The position of fourth domain for this keyword in organic or Ads results"
            ],
        "P4" =>
            [
                "description" => "The position of fifth domain for this keyword in organic or Ads results"
            ],
        "Pc" =>
            [
                "description" => "Number of keywords"
            ],
        "Pd" =>
            [
                "description" => "The difference between keyword position in previous month and keyword position in current month"
            ],
        "Ph" =>
            [
                "description" => "The keyword bringing users to the website via Google's top 20 organic search results."
            ],
        "Po" =>
            [
                "description" => "The position the URL gets in organic search for the given keyword at the specified period."
            ],
        "Pp" =>
            [
                "description" => "The site's position for the search query (at the time of prior data collection)"
            ],
        "Pt" =>
            [
                "description" => "An estimation of how much traffic site would get if it was ranked #1"
            ],
        "Qu" =>
            [
                "description" => "Query"
            ],
        "Rh" =>
            [
                "description" => "The SEMrush rating of the websites’s popularity based on organic traffic coming from Google's top 20 organic search results."
            ],
        "Rk" =>
            [
                "description" => "The SEMrush rating of the websites’s popularity based on organic traffic coming from Google's top 20 organic search results."
            ],
        "Rt" =>
            [
                "description" => "Report type"
            ],
        "Tc" =>
            [
                "description" => "Estimated price of the given keyword in Google AdWords."
            ],
        "Td" =>
            [
                "description" => "The interest of searchers in the given keyword during the period of 12 months. The metric is based on changes in the number of queries per month."
            ],
        "Tm" =>
            [
                "description" => "Organic traffic changes"
            ],
        "Tr" =>
            [
                "description" => "The share of traffic driven to the website with the given keyword for the specified period."
            ],
        "Ts" =>
            [
                "description" => "UNIX Timestamp"
            ],
        "Tt" =>
            [
                "description" => "Ad Title"
            ],
        "Um" =>
            [
                "description" => "Organic traffic cost changes"
            ],
        "Ur" =>
            [
                "description" => "Url of the target page"
            ],
        "Vu" =>
            [
                "description" => "Visible URL"
            ],
        "ads_count" =>
            [
                "description" => "The total number of all types of ads during the reporting period"
            ],
        "ads_overall" =>
            [
                "description" => "The total number of all types of ads for all time"
            ],
        "advertisers_count" =>
            [
                "description" => "The total number of advertisers by 7 days"
            ],
        "advertisers_overall" =>
            [
                "description" => "The total number of advertisers"
            ],
        "anchor" =>
            [
                "description" => "Text between open and close <a> tag"
            ],
        "avg_positions" =>
            [
                "description" => "An average position of the ad"
            ],
        "domain" =>
            [
                "description" => "Domain name"
            ],
        "external_num" =>
            [
                "description" => "External links number on source page"
            ],
        "first_seen" =>
            [
                "description" => "Timestamp when we have seen for the first time (s)"
            ],
        "image_alt" =>
            [
                "description" => "Image alt between open and close <a> tag"
            ],
        "image_url" =>
            [
                "description" => "Image url between open and close <a> tag"
            ],
        "internal_num" =>
            [
                "description" => "Internal links number on source page"
            ],
        "last_seen" =>
            [
                "description" => "Timestamp when we have seen for the last time (s)"
            ],
        "media_ads_count" =>
            [
                "description" => "The total number of media ads during the reporting period"
            ],
        "media_ads_overall" =>
            [
                "description" => "The total number of media ads for all time"
            ],
        "media_type" =>
            [
                "description" => "Media type of the ad"
            ],
        "publishers_count" =>
            [
                "description" => "The total number of publishers by 7 days"
            ],
        "publishers_overall" =>
            [
                "description" => "The total number of publishers"
            ],
        "redirect_url" =>
            [
                "description" => "Last url in redirect chain"
            ],
        "response_code" =>
            [
                "description" => "Server response code"
            ],
        "source_title" =>
            [
                "description" => "Title of the source page"
            ],
        "source_size" =>
            [
                "description" => "Source page size in bytes"
            ],
        "source_url" =>
            [
                "description" => "Url of the source page"
            ],
        "target_title" =>
            [
                "description" => "Title of the target page"
            ],
        "target_url" =>
            [
                "description" => "Url of the target page (Backlinks)"
            ],
        "target_url" =>
            [
                "description" => "Landing page of the ad (AdSense)"
            ],
        "text" =>
            [
                "description" => "Text of the ad"
            ],
        "text_ads_count" =>
            [
                "description" => "The total number of text ads during the reporting period"
            ],
        "text_ads_overall" =>
            [
                "description" => "The total number of text ads for all time"
            ],
        "times_seen" =>
            [
                "description" => "Number of times we saw ad"
            ],
        "title" =>
            [
                "description" => "Title of the ad"
            ],
        "type" =>
            [
                "description" => "The metrics indicates the backlink type"
            ],
        "visible_url" =>
            [
                "description" => "Visible url of the ad"
            ]
    ];

    /**
     * Is the field a valid one?
     *
     * @param $code
     * @return bool
     */
    public function isValidField($code)
    {
        return isset($this->fields[$code]);
    }

    /**
     * Get the description of a field
     *
     * @param $code
     * @throws InvalidFieldException
     * @return mixed
     */
    public function getFieldDescription($code)
    {
        if (!$this->isValidField($code)) {
            throw new InvalidFieldException();
        }
        return $this->fields[$code]['description'];
    }

} 