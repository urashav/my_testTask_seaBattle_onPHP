<?php
/**
 * Created by PhpStorm.
 * User: urashav
 * Date: 2019-03-04
 * Time: 10:11
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

const BASE_DIR = __DIR__  . DIRECTORY_SEPARATOR . '..';

require_once BASE_DIR . '/src/Core/Application.php';

use Core\Application;

$app = new Application();

try {
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
