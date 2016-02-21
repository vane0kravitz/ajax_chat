<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 16:38
 */

namespace app\models;

use \vendor\project_core\Mongodb,
    \app\models\User,
    \app\models\Client;

class Comment extends Mongodb
{

    public function read(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $client = new Client();
        $clientId = $client->findOrCreate(['domain' => $args['domain']]);
        $results = $collection->find(['clientId' => $clientId]);
        print_r($results);
        return $results;
    }

    public function create(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $collection->insert(
            [
                'createdAt' => new \MongoDate(),
                'updatedAt' => new \MongoDate(),
                'clientId' => $args['clientId'],
                'userId' => $args['userId'],
                'comment' => $args['comment'],
                'rating' => '',
                'votedCount' => ''
            ],
            [
                "w" => 1 // insert success?
            ]
        );
        return true;
    }

    public function update(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $collection->update(
            [
                '_id' => new \MongoId($args['_id']),
            ],
            [
                '$set' => [
                    'comment' => $args['comment'],
                    'updatedAt' => new \MongoDate()
                ]
            ]
        );
    }

    public function rateIt(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $collection->update(
            [
                '_id' => new \MongoId($args['_id']),
            ],
            [
                '$set' => [
                    'rating' => $args['rating'],
                ],
                '$inc' => [
                    'votedCount' => +1
                ]
            ]
        );
    }

    public function delete(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;
        $collection->remove(['_id' => new \MongoId($args['_id'])]);
    }
}