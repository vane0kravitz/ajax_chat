<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 17:34
 */

namespace app\controllers;

use \app\models\Comment,
    \vendor\project_core\View;

class mainController
{

    public function index() {
        $view = new View();
        echo $view->render('main', array('title' => 'home'));
    }

    public function docs() {
        $view = new View();
        echo $view->render('docs', array('title' => 'docs'));
    }

    public function test() {
        $comment = new Comment();
        if($comment->update()) {
            echo 'good job!';
        }
    }

    public function test2() {

        if ($this->is_ajax()) {
            if (isset($_POST['fname']) && !empty($_POST['fname']) &&
                isset($_POST['lname']) && !empty($_POST['lname']) &&
                isset($_POST['comment']) && !empty($_POST['comment'])) {
                $res = [
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                    'comment' => $_POST['comment'],
                    'realip' => $_POST['ip'],
                    'ip' => $_SERVER['REMOTE_ADDR']
                ];
                echo json_encode($res);
            }
        }

    }

    public function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

}