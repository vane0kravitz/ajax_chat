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

    public function find(array $args = []) {
        $this->connect('user');
        $collection = $this->collection;

        $results = $collection->findOne(['realIp' => $args['realIp']]);
        if($results) {
            return $results['_id']->{'$id'};
        }
    }

    public function access(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $results = $collection->findOne(['_id' => new \MongoId($args['commentId'])]);
        if($results['userId'] == $args['userId']) {
            // var_dump($args['userId']);
            return true;
        }
    }

    public function accessRate(array $args = []) {  //userId commentId rating
        $this->connect('rating');
        $collection = $this->collection;

        $results = $collection->findOne([
            'userId' => new \MongoId($args['userId']),
            'commentId' => new \MongoId($args['commentId']),
        ]);
        if (!$results) {
            $collection->insert(
                [
                    'createdAt' => new \MongoDate(),
                    'updatedAt' => new \MongoDate(),
                    'userId' => new \MongoId($args['userId']),
                    'comentId' => new \MongoId($args['commentId']),
                    'rating' => $args['rating'],
                ]
            );

            $this->connect('comment');
            $collection = $this->collection;
            $collection->update(
                [
                    '_id' => new \MongoId($args['commentId']),
                ],
                [
                    '$inc' => [
                        'votedCount' => +1,
                        'rating' => +$args['rating']
                    ]
                ]
            );
            return true;
        }
    }

    public function getName($userId) {
        $this->connect('user');
        $collection = $this->collection;

        $results = $collection->findOne(['_id' => new \MongoId($userId)]);
        return $results['fname'].' '.$results['lname'];
    }
}