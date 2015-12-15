<?php

/**
 * Created by PhpStorm.
 * User: Mo
 * Date: 12/14/2015
 * Time: 7:57 PM
 */
class ResultTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $symbol;

    /**
     * @var \Yql\Query
     */
    private $query;

    /**
     * @var \Yql\Result
     */
    private $result;

    public function setUp() {
        require 'vendor/autoload.php';

        $this->startDate = new \DateTime("5 years ago");
        $this->endDate = new \DateTime("4 years ago");
        $this->symbol = 'AAPL';

        // make the query
        $this->query = sprintf(
            "select * from yahoo.finance.historicaldata where startDate='%s' and endDate='%s' and symbol='%s'",
            $this->startDate->format("Y-m-d"),
            $this->endDate->format("Y-m-d"),
            $this->symbol
        );

        // get result
        $this->result = \Yql\Query::execute($this->query);
    }

    public function testResultIsJSON() {
        $this->assertInstanceOf('\JSONSerializable', $this->result);
    }

    public function testHasData() {
        $this->assertGreaterThanOrEqual(1, count($this->result->data), 'Result has some data');
    }
}
