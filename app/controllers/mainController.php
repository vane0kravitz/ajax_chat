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

}