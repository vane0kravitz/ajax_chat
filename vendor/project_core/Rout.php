<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 19:20
 */
// action inspection needed
namespace vendor\project_core;


class Rout
{
    public function start() {
        (string)$rout = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        if (preg_match("/.css/", $rout) || preg_match("/.js/", $rout)) { // its very simple because i use only 2 files
            if (preg_match("/.css/", $rout)){
                ob_start();
                header("Content-type: text/css; charset: UTF-8");
                include ('../web/css/main.css');
                echo ob_get_clean();
            }
            if(preg_match("/.js/", $rout)){
                include ('../web/js/main.js');
            }
        }else{
            $rout_arr = explode('/', $rout); /* explode to array by slash */
            array_shift($rout_arr); /* first slash */
            array_shift($rout_arr); /* web */
            $smallController = array_shift($rout_arr); /* cut first element */
            if(!isset($smallController) || $smallController == "") {
                $smallController = 'main';
            }

            $action =(string) array_shift($rout_arr);
            if(!isset($action) || $action == "") {
                $action = 'index';
            }

            $controller = 'app\\controllers\\' . $smallController . 'Controller';
            $file = '../app/controllers/' . $smallController . 'Controller.php';
            if(isset($smallController) && is_file($file)){
                $controller_obj = new $controller();
                $controller_obj->$action();
            }else{
                echo '<br><h1>404 not found</h1>';
            }
        }

    }
}