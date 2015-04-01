<?php

namespace Silktide\SemRushApi\Cache;

use Silktide\SemRushApi\Helper\SerialiseRequest;
use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result;

class MemoryCache implements CacheInterface {

    use SerialiseRequest;

    /**
     * @var Result
     */
    protected $cache = [];

    /**
     * Save the result for a given request
     *
     * @param Request $request
     * @param Result $result
     * @return mixed
     */
    public function cache(Request $request, Result $result)
    {
        $key = $this->serialise($request);
        $this->cache[$key] = $result;
    }

    /**
     * Fetch the result for a given request
     *
     * @param Request $request
     * @return Result|null
     */
    public function fetch(Request $request)
    {
        $key = $this->serialise($request);
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }
    }
}