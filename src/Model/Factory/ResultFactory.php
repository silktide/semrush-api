<?php


namespace Silktide\SemRushApi\Model\Factory;

use Silktide\SemRushApi\Model\Result;

class ResultFactory {


    /**
     * @var RowFactory
     */
    protected $rowFactory;

    /**
     * @param RowFactory $rowFactory
     */
    public function __construct(RowFactory $rowFactory)
    {
        $this->rowFactory = $rowFactory;
    }

    /**
     * Takes raw API data and converts into a result
     *
     * @param array $data
     * @return Result
     */
    public function create($data)
    {
        $result = new Result();
        $rows = [];
        foreach ($data as $row) {
            $rows[] = $this->rowFactory->create($row);
        }
        $result->setRows($rows);
        return $result;
    }

} 