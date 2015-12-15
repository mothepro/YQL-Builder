<?php
namespace Yql;
use Traversable;

/**
 * Data returned from Yahoo
 *
 * @author Maurice Prosper <maurice.prosper@ttu.edu>
 * @package YQL
 */

class Result implements \JsonSerializable, \IteratorAggregate {
    /**
     * number of results
     * @var int
     */
    private $count;

    /**
     * Time of query
     * @var \DateTime
     */
    private $created;

    /**
     * Query language
     * @var string
     */
    private $lang;

    /**
     * Diagnostics
     * @var \stdClass|null
     */
    private $diag;

    /**
     * Data from query
     * @var \stdClass
     */
    public $data;

    public function __construct($data) {
        if(is_string($data))
            $data = json_decode ($data);

        if(isset($data->error))
            throw new \YQL\Exception($data->error->description);

        $this->count	= intval($data->query->count);
        $this->created	= new \DateTime($data->query->created);
        $this->lang		= $data->query->lang;

        if(isset($data->query->diagnostics))
            $this->diag		= $data->query->diagnostics;

        $this->data		= $data->query->results;
    }

    public function jsonSerialize() {
        return $this->data;
    }

    public function getIterator() {
        return $this->data;
    }
}