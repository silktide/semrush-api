<?php

namespace Silktide\SemRushApi\Helper;

use Silktide\SemRushApi\Model\Request;

class UrlBuilder {

    /**
     * @var Request
     */
    protected $request;

    public function build(Request $request, $endpoint=NULL)
    {
        $this->request = $request;
        return $this->getUrl($endpoint);
    }

    /**
     * Convert options to strings.  At the moment, it just implodes export
     * columns to be comma separated
     *
     * @return string[]
     */
    protected function getOptionsAsStrings()
    {
        $options = $this->request->getUrlParameters();
        if (isset($options['export_columns'])) {
            $options['export_columns'] = implode(",", $options['export_columns']);
        }
        return $options;
    }

    /**
     * Get the URL of this request
     *
     * @return string
     */
    protected function getUrl($endpoint=NULL)
    {
        $params = $this->getOptionsAsStrings();
        return $this->request->getEndpoint($endpoint) . "?" . http_build_query($params);
    }

}
