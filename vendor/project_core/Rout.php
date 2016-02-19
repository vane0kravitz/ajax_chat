<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 19:20
 */

namespace vendor\project_core;


class Rout
{
    public function start() {
        (string)$rout = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

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

        if(isset($smallController)){
            $controller = 'app\\controllers\\' . $smallController . 'Controller';
            $controller_obj = new $controller();
            $controller_obj->$action();
        }else{
            echo '<br>404 not found';
        }
    }
}