<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 17:34
 */

namespace app\controllers;


class mainController
{
    public $test = 'test!';

    public function index() {
        echo 'site root';
    }

    public function article() {
        echo 'article';
    }
}