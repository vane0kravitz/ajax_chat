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
                $val = array();
                $buf = [];
                $i = 0;
                foreach ( $res as $value ) {
                    $name = $user->getName($value['userId']->{'$id'});
                    $buf[$i]['id'] = $value['_id']->{'$id'};
                    $buf[$i]['comment'] = $value['comment'];
                    $buf[$i]['name'] = $name;
                    $i++;
                    //$buf = array_merge($buf, $val);
                    //exit;
                }
//                print_r($buf);
                echo json_encode($buf, JSON_FORCE_OBJECT);
//                var_dump($buf);
            }
        }

    }

    public function update() {

    }

    public function rateIt() {

    }

    public function delete() {

    }

    public function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

}