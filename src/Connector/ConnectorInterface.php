<?php


namespace AndyWaite\SemRushApi\Connector;


interface ConnectorInterface {

    /**
     * Get the API response for the given URL
     *
     * @param string $url
     * @return string
     */
    public function get($url);

} 