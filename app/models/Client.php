<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 16:17
 */

namespace app\models;

use \vendor\project_core\Mongodb;

class Client extends Mongodb
{
    public function findOrCreate(array $args = []){
        $this->connect('client');
        $collection = $this->collection;

        $results = $collection->findOne(['domain' => $args['domain']]);
        if($results) {
            return $results['_id'];
        }else{
            $collection->insert(
                [
                    'createdAt' => new \MongoDate(),
                    'domain' => $args['domain'],
                ]
            );
            $newResults = $collection->findOne(['domain' => $args['domain']]);
            return $newResults['_id'];
        }
    }
}