<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 18:03
 */

namespace vendor\project_core;


class mongodb
{
    public $dbname = "ajaxcomments";
    public $collection;

    public function connect($collection) {
        $mongo = new \MongoClient();
        $dbname = $this->dbname;
        $db = $mongo->$dbname;
        $this->collection = $db->$collection;
    }
}