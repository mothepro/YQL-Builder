<?php

/**
 * Created by PhpStorm.
 * User: Mo
 * Date: 12/14/2015
 * Time: 1:05 PM
 *
 * Query taken from
 * @link https://developer.yahoo.com/yql/
 */
class QueryTest extends PHPUnit_Framework_TestCase {
    private $query;

    protected function setUp() {
        require 'vendor/autoload.php';

        $this->query = "select * from html where url='http://en.wikipedia.org/wiki/Yahoo' and xpath='//table/*[contains(.,\"Founder\")]//a'";
    }

    public function testExecute() {
        $ret = \Yql\Query::execute($this->query);
        $this->assertInstanceOf(\Yql\Result::class, $ret, 'A Query returns a Result');
    }
}
