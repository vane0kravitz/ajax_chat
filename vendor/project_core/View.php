<?php
/**
 * User: vane0kravitz
 * Date: 20.02.16
 * Time: 19:07
 */

namespace vendor\project_core;


class View
{
    function render($file, $variables = array()) {
        extract($variables);

        ob_start();
        include ('../app/views/'.$file.'.php');
        $renderedView = ob_get_clean();

        return $renderedView;
    }
}