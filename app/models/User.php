<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 16:38
 */

namespace app\models;

use \vendor\project_core\Mongodb;

class User extends Mongodb
{
    public function findOrCreate(array $args = []) {
        $this->connect('user');
        $collection = $this->collection;

        $results = $collection->findOne(['realIp' => $args['realIp']]);
        if($results) {
            return $results['_id'];
        }else{
            $collection->insert(
                [
                    'createdAt' => new \MongoDate(),
                    'updatedAt' => new \MongoDate(),
                    'realIp' => $args['realIp'],
                    'ip' => $args['ip'],
                    'fname' => $args['fname'],
                    'lname' => $args['lname'],
                ]
            );
            $newResults = $collection->findOne(['realIp' => $args['realIp']]);
            return $newResults['_id'];
        }
    }

    public function getName($userId) {
        $this->connect('user');
        $collection = $this->collection;

        $results = $collection->findOne(['_id' => new \MongoId($userId)]);
        return $results['fname'].' '.$results['lname'];
    }
}