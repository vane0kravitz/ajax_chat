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
        $results = iterator_to_array($collection->find(['clientId' => new \MongoId($clientId)]));
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
                'rating' => 0,
                'votedCount' => 0
            ],
            [
                "w" => 1 // insert success?
            ]
        );
        $findId = iterator_to_array($collection->find(['comment' => $args['comment'], 'userId' => new \MongoId($args['userId'])]));
        $findId = array_shift($findId);
        $findId = array_shift($findId)->{'$id'};
        return $findId;
    }

    public function update(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $collection->update(
            [
                '_id' => new \MongoId($args['id']),
            ],
            [
                '$set' => [
                    'comment' => $args['comment'],
                    'updatedAt' => new \MongoDate()
                ]
            ]
        );
       // var_dump($args['id']);
        return true;
    }

    public function rateIt(array $args = []) {
        $this->connect('comment');
        $collection = $this->collection;

        $collection->update(
            [
                '_id' => new \MongoId($args['commentId']),
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