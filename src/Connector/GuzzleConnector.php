<?php


namespace AndyWaite\SemRushApi\Connector;


use Guzzle\Http\Client;

class GuzzleConnector implements ConnectorInterface {

    /**
     * Get the API response for the given URL
     *
     * @param string $url
     * @return string
     */
    public function get($url)
    {
        $client = new Client();
        $response = $client->get($url);
        return $response->getResponseBody();
    }

} 