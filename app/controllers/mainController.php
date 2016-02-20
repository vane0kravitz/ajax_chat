<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 17:34
 */

namespace app\controllers;

use \app\models\Comment;


class mainController
{

    public function index() {
        echo 'site root';
    }

    public function article() {
        echo 'article';
    }

    public function test() {
        $comment = new Comment();
        if($comment->update()) {
            echo 'good job!';
        }
    }

}