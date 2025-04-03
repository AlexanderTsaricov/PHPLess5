<?php
require_once ('../vendor/autoload.php');

use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Application\Application;

try {
    $app = new Application();
    echo $app->run();
} catch (Exception $e) {
    $render = new Render();
    echo $render->renderExeptionPage($e);
}

$memory_end = memory_get_usage();