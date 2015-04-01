<?php

namespace Silktide\SemRushApi\Cache;

use Silktide\SemRushApi\Model\Request;
use Silktide\SemRushApi\Model\Result;

interface CacheInterface {

    /**
     * Save the result for a given request
     *
     * @param Request $request
     * @param Result $result
     * @return mixed
     */
    public function cache(Request $request, Result $result);

    /**
     * Fetch the result for a given request
     *
     * @param Request $request
     * @return Result|null
     */
    public function fetch(Request $request);

} 