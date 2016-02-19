<?php
/**
 * User: vane0kravitz
 * Date: 19.02.16
 * Time: 16:21
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

require '../vendor/project_core/Loader.php';

$loader = new Loader();
spl_autoload_register([$loader, 'loadClass']);

$rout = new \vendor\project_core\Rout();
$rout->start();