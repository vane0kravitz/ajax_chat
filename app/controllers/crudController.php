<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 16:22
 */

namespace app\controllers;

use \app\models\Comment,
    \app\models\User,
    \app\models\Client;


class crudController
{

    public function create() {
        $comment = new Comment();
        $user = new User();
        $client = new Client();

        if ($this->is_ajax()) {
            if (isset($_POST['fname']) && !empty($_POST['fname']) &&
                isset($_POST['lname']) && !empty($_POST['lname']) &&
                isset($_POST['comment']) && !empty($_POST['comment'])) {
                $userId = $user->findOrCreate([
                    'realIp' => $_POST['ip'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                ]);
                $clientId = $client->findOrCreate(['domain' => $_POST['domain']]);
                $res = $comment->create([
                    'domain' => $_POST['ip'],
                    'comment' => $_POST['comment'],
                    'realip' => $_POST['ip'],
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'clientId' => $clientId,
                    'userId' => $userId
                ]);
                $response = [
                    'id' => $res,
                    'comment' => $_POST['comment'],
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname']
                ];
                echo json_encode($response);
            }
        }
    }

    public function read() {
        $comment = new Comment();
        $user = new User();

        //get all comments, foreach array and send all comment in json
        if ($this->is_ajax()) {
            if (isset($_POST['domain']) && !empty($_POST['domain'])) {
                $res = $comment->read([
                    'domain' => $_POST['domain']
                ]);
                $val = [];
                $buf = [];
                $i = 0;
                foreach ( $res as $value ) {
                    $name = $user->getName($value['userId']->{'$id'});
                    $buf[$i]['id'] = $value['_id']->{'$id'};
                    $buf[$i]['comment'] = $value['comment'];
                    $buf[$i]['name'] = $name;
                    $i++;
                }
                echo json_encode($buf, JSON_FORCE_OBJECT);
            }
        }
    }

    public function update() {
        $comment = new Comment();
        $user = new User();

        if ($this->is_ajax()) {
            if (isset($_POST['ip']) && !empty($_POST['ip']) &&
                isset($_POST['domain']) && !empty($_POST['domain']) &&
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['comment']) && !empty($_POST['comment'])) {
                
                $userId = $user->find(['realIp' => $_POST['ip']]);
                if ($userId && $user->access(['userId' => $userId, 'commentId' => $_POST['id']])) {
                    $res = $comment->update([
                        'id' => $_POST['id'],
                        'comment' => $_POST['comment']
                    ]);
                    echo json_encode(['ok' => 'ok'], JSON_FORCE_OBJECT);
                }
            }
        }
    }

    public function rate() { // id ip rating domain
        $comment = new Comment();
        $user = new User();

        if ($this->is_ajax()) {
            if (isset($_POST['ip']) && !empty($_POST['ip']) &&
                isset($_POST['domain']) && !empty($_POST['domain']) &&
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['rating']) && !empty($_POST['rating'])) {
                $userId = $user->find(['realIp' => $_POST['ip']]);
                if ($userId && !$user->accessRate(['userId' => $userId, 'commentId' => $_POST['id'], 'rating' => $_POST['rating']])) {
                    $res = $comment->rateIt([
                        'userId' => $userId,
                        'commentId' => $_POST['id'],
                        'rating' => $_POST['rating'],
                        'domain' => $_POST['domain']
                    ]);
                    echo json_encode(['ok'], JSON_FORCE_OBJECT);
                }
            }
        }
    }

    public function delete() {
        $comment = new Comment();
        $user = new User();

        if ($this->is_ajax()) {
            if (isset($_POST['ip']) && !empty($_POST['ip']) &&
                isset($_POST['id']) && !empty($_POST['id'])) {
                $userId = $user->find(['realIp' => $_POST['ip']]);
                if ($userId && $user->access(['userId' => $userId, 'commentId' => $_POST['id']])) {
                    $res = $comment->delete([
                        '_id' => $_POST['id']
                    ]);
                    echo json_encode(['ok'], JSON_FORCE_OBJECT);
                }
            }
        }
    }

    public function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

}