<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 16:10
 */

class Loader
{
    public function loadClass($class) /* app\mvc\Class namespace */
    {
        $arr = explode('\\', $class); /* explode to array by inverted slash */
        $pref = array_shift($arr); /* cut first element */

        $pref_file = null;
        if($pref == 'app') {
            $pref_file = '../app/';
        }elseif($pref == 'vendor'){
            $pref_file = '../vendor/';
        }

        $file = $pref_file . implode('/', $arr) . '.php';


        if(is_file($file)) {
            require_once $file;
        }

    }
}