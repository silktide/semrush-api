<?php

namespace Silktide\SemRushApi\Helper;

use Silktide\SemRushApi\Model\Request;

trait SerialiseRequest {

    /**
     * Serialise the request
     *
     * @param Request $request
     * @return string
     */
    public function serialise(Request $request)
    {
        $parameters = $request->getUrlParameters();
        ksort($parameters);

        $string = "";

        array_walk($parameters, function($value, $key) use (&$string) {
            if (is_array($value)) {
                $value = implode("", $value);
            }
            $string .= $key.$value;
        });

        return md5($string);
    }

}